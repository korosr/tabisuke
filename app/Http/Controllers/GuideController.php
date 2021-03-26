<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuideRequest;
use App\Http\Requests\PlanRequest;
use App\Models\Category;
use App\Models\Guide;
use App\Models\GuidePlan;
use App\Models\Plan;
use DateTime;
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

    //登録処理
    public function store(GuideRequest $guidereq, PlanRequest $planreq){
        
        $guide = new Guide();
        $guide->create([
            'title' => $guidereq->input('title'),
            'sub_title' => $guidereq->input('subtitle'),
            'shared_memo' => $guidereq->input('shared_memo'),
        ]);

        $plan = new Plan();
        //時間と日付を一緒にする
        $datetime_in = strtotime($guidereq->input('date')[0].$guidereq->input('time')[0]);
        $datetime = date('Y-m-d H:i:s', $datetime_in);
       
        $plan->create([
            'date_time' => $guidereq->input($datetime),
            'plan_title' => $guidereq->input('plan_title')[0],
            'contents' => $guidereq->input('contents')[0],
            'category_id' => $guidereq->input('category_id')[0],
        ]);

        $guide_plan = new GuidePlan();
        $guide_plan->create([
            'guide_id' => $guide->id,
            'plan_id' => $plan->id,
        ]);

        return view('index');
    }
}