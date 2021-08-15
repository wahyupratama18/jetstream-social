<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateUser;
use App\Models\SocialLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    use CreateUser;

    /**
     * Socialite Redirection
     *
     * @return mixed
     */
    public function redirect(Request $request)
    {
        return Socialite::driver($request->driver)->redirect();
    }

    /**
     * Social Login Callback
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        try {

            $social = Socialite::driver($request->driver)->user();
            $driver = array_search($request->driver, array_map('strtolower', SocialLogin::DRIVES));

            if (Auth::check())
                $this->socialSave($social->id, Auth::id(), $driver);
            else {
                
                // Check if user exists
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
            
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }

}
