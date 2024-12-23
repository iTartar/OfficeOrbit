<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Schedule_userController extends Controller
{
    public function index()
    {
        return view('Schedule_user');
    }
}