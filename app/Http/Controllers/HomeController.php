<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class HomeController extends Controller
{
    public Function showprofile(){
        return "hellow this is my profile ";
    }
}
