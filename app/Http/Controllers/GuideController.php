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
        //登録情報を取得
        $guides = Guide::all();
        $plans = Plan::orderBy('date_time')->get();
        return view('index', compact('guides','plans'));
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

        //プラン数取得
        $plan_count = count($planreq->input('date.*'));
        for($i=0; $i<$plan_count; $i++){           
            //時間と日付を一緒にする
            $datetime_in = strtotime($planreq->input('date')[$i].$planreq->input('time')[$i]);
            $datetime = date('Y-m-d H:i', $datetime_in);
            $plan = Plan::create([
                'date_time' => $datetime,
                'plan_title' => $planreq->input('plan_title')[$i],
                'contents' => $planreq->input('contents')[$i],
                'category_id' => $planreq->input('category_'.$i),
            ]);

            $guide_plan = new GuidePlan();
            $guide_plan->create([
                'guide_id' => $guide->id,
                'plan_id' => $plan->id,
            ]);
        }
        return redirect('/guides');
    }
}