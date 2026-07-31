<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function dashboard()
    {
        return view("pages.modules.dashboard");
    }
}
