<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Socialite\SocialStructure;
use App\Http\Controllers\Controller;

class GithubController extends Controller
{
    use SocialStructure;

    private $driver = 'github', $id = 4;
}
