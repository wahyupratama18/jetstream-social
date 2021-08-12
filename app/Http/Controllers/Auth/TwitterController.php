<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Socialite\SocialStructure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwitterController extends Controller
{
    use SocialStructure;

    private $driver = 'twitter', $id = 1;
}
