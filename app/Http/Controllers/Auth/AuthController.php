<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Germey\Geetest\GeetestCaptcha;
class AuthController extends Controller
{
	use GeetestCaptcha;
	
}
