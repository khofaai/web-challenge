<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    
    public function index($vue_capture = null)
    {
    	return view('index');
    }
}
