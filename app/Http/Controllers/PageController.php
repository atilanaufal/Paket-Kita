<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrackingData;

class PageController extends Controller
{
    public function home(){ return view('main.tracking');}
    public function history(){return view('main.history');}
    public function about(){return view('main.about');}
    public function settings(){return view('main.settings');}
    public function login(){return view('user.login');}
    public function editAcc(){return view('user.edit_acc');}
    public function register(){return view('user.register');}
}
