<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Socialite\SocialStructure;
use App\Http\Controllers\Controller;


class GoogleController extends Controller
{
    use SocialStructure;

    private $driver = 'google', $id = 3;

}
