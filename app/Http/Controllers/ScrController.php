<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScrController extends Controller
{
    public function index()
    {
        return view('Scr');
    }
}