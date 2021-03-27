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
        
        $guide = Guide::create([
            'title' => $guidereq->input('title'),
            'sub_title' => $guidereq->input('subtitle'),
            'shared_memo' => $guidereq->input('shared_memo'),
        ]);

        //時間と日付を一緒にする
        $datetime_in = strtotime($planreq->input('date')[0].$planreq->input('time')[0]);
        $datetime = date('Y-m-d H:i', $datetime_in);
        
        $plan = Plan::create([
            'date_time' => $datetime,
            'plan_title' => $planreq->input('plan_title')[0],
            'contents' => $planreq->input('contents')[0],
            'category_id' => $planreq->input('category')[0],
        ]);

        $guide_plan = new GuidePlan();
        $guide_plan->create([
            'guide_id' => $guide->id,
            'plan_id' => $plan->id,
        ]);

        return view('index');
    }
}