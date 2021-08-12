<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Socialite\SocialStructure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    use SocialStructure;

    private $driver = 'facebook', $id = 0;
}
