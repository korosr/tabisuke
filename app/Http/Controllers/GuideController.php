<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    //一覧表示
    public function index(){
        return view('index');
    }
    
    //作成画面表示
    public function create(){
        //カテゴリーを全て取得
        $categories = Category::all();
        return view('create', compact('categories'));
    }
}