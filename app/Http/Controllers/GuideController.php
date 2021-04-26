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
        $guide_id = ['id' => $id];
        $plans = DB::select('SELECT *, DATE_FORMAT(plans.date_time, "%Y年%m月%d日") as ymd, DATE_FORMAT(plans.date_time, "%H:%i") as hm FROM plans JOIN categories ON plans.category_id = categories.id JOIN guide_plan ON plans.id = guide_plan.plan_id WHERE guide_plan.guide_id = :id ORDER BY plans.date_time', $guide_id);
    
        $plan_guide = DB::select('SELECT plans.date_time, guides.* FROM plans, guides JOIN guide_plan ON guides.id = guide_plan.guide_id WHERE plans.id = guide_plan.plan_id and guides.id = :id  ORDER BY plans.date_time', $guide_id);
        
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
        $guides = Guide::find($id);

        //guide_idを元に全プランを取得
        $guide_id = ['id' => $id];
        $plans = DB::select('SELECT plans.id as plans_id, plans.plan_title, plans.contents, plans.category_id, DATE_FORMAT(plans.date_time, "%Y-%m-%d") as ymd, DATE_FORMAT(plans.date_time, "%H:%i") as hm FROM plans JOIN categories ON plans.category_id = categories.id JOIN guide_plan ON plans.id = guide_plan.plan_id WHERE guide_plan.guide_id = :id ORDER BY plans.date_time', $guide_id);
        
        return view('edit', compact('categories','guides', 'plans'));
    }

    //編集処理
    public function updateGuide($id, GuideRequest $guidereq, PlanRequest $planreq){
        if($guidereq->has('edit')){      
            //guide更新
            Guide::where('id', '=', $id)
            ->update(['title' => $guidereq->input('title'),
                    'sub_title' => $guidereq->input('subtitle'),
                    'shared_memo' => $guidereq->input('shared_memo'),
                    ]);
            //plan更新
            $plan_ids = $planreq->input('plan_id');
        
            for($i=0; $i<count($plan_ids); $i++){
                //時間と日付を一緒にする
                $datetime_in = strtotime($planreq->input('date')[$i].$planreq->input('time')[$i]);
                $datetime = date('Y-m-d H:i', $datetime_in);
                Plan::where('id', '=', $plan_ids[$i])
                ->update(['date_time' => $datetime,
                        'plan_title' => $planreq->input('plan_title')[$i],
                        'contents' => $planreq->input('contents')[$i],
                        'category_id' => $planreq->input('category_'.$plan_ids[$i]),
                        ]);
            }

            //新規のplan
            //プラン数取得
            $newplan = $planreq->input('newplan_title');
            for($i=0; $i<count($newplan); $i++){
                if($newplan[$i] != null){           
                    //時間と日付を一緒にする
                    $datetime_in = strtotime($planreq->input('newdate')[$i].$planreq->input('newtime')[$i]);
                    $datetime = date('Y-m-d H:i', $datetime_in);
                    $plan = Plan::create([
                        'date_time' => $datetime,
                        'plan_title' => $planreq->input('newplan_title')[$i],
                        'contents' => $planreq->input('newcontents')[$i],
                        'category_id' => $planreq->input('newcategory_'.$i),
                    ]);
        
                    $guide_plan = new GuidePlan();
                    $guide_plan->create([
                        'guide_id' => $id,
                        'plan_id' => $plan->id,
                    ]);
                }
            }
        }

        if($guidereq->has('delete')){
            $plan_id = $planreq->input('delete');
            //planから削除
            $plans = Plan::find($plan_id)->delete();
            //guide_planから削除
            $guide_plan = GuidePlan::where('plan_id', $plan_id)->delete();
            return redirect()->route('guides.edit', ['guide' => $id]);
        }
        return redirect()->route('guides.show', ['guide' => $id]);
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

    //削除処理
    public function deleteGuide($id){
        //guideIDを基にplanID取得
        $plan_ids = GuidePlan::where('guide_id', $id)->pluck('plan_id');
        //planから削除
        foreach($plan_ids as $plan_id){
            Plan::where('id', $plan_id)->delete();
        }

        //guideから削除
        $guide = Guide::find($id)->delete();
        //guide_planから削除
        $guide_plan = GuidePlan::where('guide_id', $id)->delete();

        return redirect('/guides');

    }

}