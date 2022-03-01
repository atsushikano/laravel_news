<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use Illuminate\Contracts\Session\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class ExtraController extends Controller
{
    public function Japanese()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session()->put('lang', 'japanese');
        return Redirect()->back();
    }

    public function English()
    {
        Session::get('lang');
        Session()->forget('lang');
        Session()->put('lang', 'english');
        return Redirect()->back();
    }
}
