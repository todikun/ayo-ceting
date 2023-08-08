<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataStuntingController extends Controller
{
    public function index()
    {
        return view('pages.data-stunting.index');
    }
}
