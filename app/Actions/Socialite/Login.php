<?php
namespace App\Actions\Socialite;

use App\Models\{SocialLogin, Team, User};
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;

/**
 * 
 */
trait Login
{
    protected function login($social, $driver)
    {
        
        /**
         * Direct to socialSave
         */
        if (Auth::check()) $this->socialSave($social->id, Auth::id(), $driver);
        else {
            
            // Cek dulu
            $find = SocialLogin::with('user')
            ->where('social_id', $social->id)
            ->where('driver_id', $driver)
            ->first();

            $login = ($find
            ? $find->user
            : $this->createUser(
                $social->name,
                $social->email,
                '',
                ['id' => $social->id, 'driver' => $driver]
            ));

            Auth::login($login, true);
        }

        return redirect(config('fortify.home'));
    }

    /**
     * Social First Or Creation
     *
     * @param string $social
     * @param integer $user
     * @param integer $driver
     * @return SocialLogin
     */
    protected static function socialSave(string $social, int $user, int $driver): SocialLogin
    {
        return SocialLogin::firstOrCreate([
            'social_id' => $social,
            'user_id' => $user,
            'driver_id' => $driver
        ]);
    }

    /**
     * Create New User
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param array $social
     * @return User
     */
    protected function createUser(string $name, string $email, string $password = '', array $social = null): User
    {
        return DB::transaction(function () use ($name, $email, $password, $social) {
            return tap(User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]), function (User $user) use ($social) {
                $this->createTeam($user);
                // Social Login
                if ($social !== null)  $this->socialSave($social['id'], $user->id, $social['driver']);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user): void
    {
        if (Jetstream::hasTeamFeatures())
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]));
    }
}
