<?php
namespace App\Actions\Fortify;

use App\Models\{SocialLogin, Team, User};
use Illuminate\Support\Facades\{DB, Hash};
use Laravel\Jetstream\Jetstream;

/**
 * 
 */
trait CreateUser
{

    /**
     * Create New User
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param array $social
     * @return \App\Models\User
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
        if (Jetstream::hasTeamFeatures() && $user->role != 3)
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]));
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
}
