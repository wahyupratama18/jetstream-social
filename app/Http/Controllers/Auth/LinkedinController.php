<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Socialite\SocialStructure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LinkedinController extends Controller
{
    use SocialStructure;

    private $driver = 'linkedin', $id = 2;
}
