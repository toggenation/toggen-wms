<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BlankController extends Controller
{
    function placeHolder()
    {
        return Inertia::render('Blank/Index');
    }
}
