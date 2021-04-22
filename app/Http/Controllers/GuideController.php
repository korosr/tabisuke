<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
        //全ガイド取得
        $plan_guide = DB::select("SELECT DATE_FORMAT(plans.date_time, '%Y年%m月%d日') as guide_date, guides.id, guides.title FROM plans, guides JOIN guide_plan ON guides.id = guide_plan.guide_id WHERE plans.id = guide_plan.plan_id GROUP BY guides.id");
        
        return view('index', compact('plan_guide'));

        
    }

    //詳細画面を表示
    public function show($id){
        //登録情報を取得
        $plans = DB::select('SELECT *, DATE_FORMAT(plans.date_time, "%Y年%m月%d日") as ymd, DATE_FORMAT(plans.date_time, "%H:%i") as hm FROM plans JOIN categories ON plans.category_id = categories.id JOIN guide_plan ON plans.id = guide_plan.plan_id WHERE guide_plan.guide_id = ' .$id. ' ORDER BY plans.date_time');
    
        $plan_guide = DB::select('SELECT plans.date_time, guides.* FROM plans, guides JOIN guide_plan ON guides.id = guide_plan.guide_id WHERE plans.id = guide_plan.plan_id and guides.id ='. $id);
        
        $plan_ymd = array();
        foreach($plan_guide as $plans_date){
            $pdt = new DateTime($plans_date->date_time);
            $plan_ymd[] = $pdt->format('Y年m月d日');
        }
        //日付が重複しているものは削除
        $plan_day = array_unique($plan_ymd);

        $plan_day = array_values($plan_day);
        
        return view('show', compact('plan_guide','plans', 'plan_day'));
    }
    
    //作成画面表示
    public function create(){
        //カテゴリーを全て取得
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    //編集画面表示
    public function edit($id){
        //カテゴリーを全て取得
        $categories = Category::all();
        //IDを元にDBからguide情報を取得
        //$guides = Guide::find($id);
        
        $plan_guide= DB::table('guide_plan')
        ->join('guides', 'guide_plan.guide_id', '=', 'guides.id')
        ->where('guides.id', $id)
        ->get();

        $plan_id = array();
        foreach($plan_guide as $value){
            array_push($plan_id, $value->plan_id);
        }

        $plan = Plan::select('*')
        ->join('categories', 'plans.category_id', '=', 'categories.id')
        ->join('guide_plan', 'plans.id', '=', 'guide_plan.plan_id')
        ->where('guide_plan.guide_id', $id)
        ->orderBy('plans.date_time','asc')
        ->get();

        $ymd = array();
        $hm = array();
        foreach($plan as $value){
            array_push($ymd, $value->date_time->format('Y年m月d日'));
            array_push($hm, $value->date_time->format('H:i'));
        }

        return view('edit', compact('categories'));
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

//select * from plans inner join categories on plans.category_id = categories.id inner join guide_plan on plans.id = guide_plan.plan_id where guide_plan.guide_id = 2 order by plans.date_time asc;