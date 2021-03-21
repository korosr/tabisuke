<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    //一覧表示
    public function index()
    {
    }
    
    //作成
    public function create(){
        return view('create');
    }
}
