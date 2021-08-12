<?php
namespace App\Actions\Socialite;

use Laravel\Socialite\Facades\Socialite;

/**
 * 
 */
trait SocialStructure
{

    use Login;

    /**
     * Socialite Redirection
     *
     * @return mixed
     */
    public function redirect()
    {
        return Socialite::driver($this->driver)->redirect();
    }

    /**
     * Social Login Callback
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function callback()
    {
        try {
            return $this->login(Socialite::driver($this->driver)->user(), $this->id);
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }
}
