<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    function index(){
        //return view('pages/index', compact('title'));
        // $title= 'Welcome to APUSUOF!';
        // ->with('title', $title)
        return view('pages.index');
    }
}
