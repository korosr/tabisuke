@extends('layouts.app')
@section('title', 'tabisuke～快適な旅をサポート～ | 旅の作成')
@section('content')
@include('nav')
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/plane.png') }}" alt="しおり画像" class="rounded-circle" width="100" height="100">
            </div>    
            <h4 class="text-center m-3 text-muted">旅のタイトル</h4>
            <form method="post" action="{{ route('guides.update', ['guide'=> $guides->id]) }}">
            @csrf
            <div class="card mt-3">
              <div class="card-body pt-0">
                <div class="card-text  p-3">            
                    <div class="md-form">
                        <label>タイトル</label>
                        <input type="text" name="title" class="form-control" value="{{ $guides->title }}">
                    </div>
                    <div class="md-form">
                        <label>サブタイトル</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ $guides->sub_title }}">
                    </div>
                </div>
            　</div>
            </div>
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/calendar.png') }}" alt="プラン画像" class="rounded-circle" width="100" height="100">
            </div> 
            <h4 class="text-center m-5 text-muted">プラン</h4>
            <div id="planbox">
            @foreach($plans as $plan)
                <div class="card mt-3 mb-3" id="planbox_0">
                    <input type="hidden" name="plan_id[]" value="{{ $plan->id }}">
                    <div class="card-body pt-0">
                        <div class="card-text p-3">
                            <div class="form-group row">
                                <div class="input-group col-sm-3">
                                    <input type="date" name="date[]" class="form-control reset" value="{{ $plan->ymd }}">
                                </div>
                                <div class="input-group col-sm-3">
                                    <input type="time" name="time[]" class="form-control reset" value="{{ $plan->hm }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="plan_title[]" class="form-control reset" value="{{ $plan->plan_title }}" placeholder="タイトル">
                            </div>
                            <div class="form-group">
                                <textarea name="contents[]" class="form-control reset" placeholder="内容">{{ $plan->contents }}</textarea>
                            </div>
                            <div class="form-group row justify-content-between">
                                <div class="form-check-inline">
                                @foreach($categories as $category)
                                    <input class="form-check-input mr-0" type="radio" id="category" name="category<?=$plan->id ?>" class="category_0" value="<?=$category->id ?>" @if($category->id == $plan->category_id) checked @endif>
                                    <label class="form-check-label mr-2">{{$category -> category_name}}</label>
                                @endforeach
                                </div>
                            </div>
                            <div class="form-group delete_btn" hidden>
                                <i class="fas fa-times fa-2x float-right col-sm-1 align-self-center text-right" id="deleteBtn_0" onclick="deletePlan(this.id)"></i>
                            </div>
                        </div>
                　  </div>
                </div>
            @endforeach
            </div>
            <button type="button" class="btn btn-outline-info waves-effect" id="addbutton" onclick="addPlan()"><i class="fas fa-plus mx-1"></i>プラン追加</button>
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/book.png') }}" alt="その他画像" class="rounded-circle" width="100" height="100">
            </div>
            <h4 class="text-center m-5 text-muted">共有事項</h4>
            <div class="card m-3">
                <div class="card-body pt-0">
                  <div class="card-text  pt-3">
                      <div class="form-group">
                        <textarea name="shared_memo" class="form-control" placeholder="内容" rows="4">{{ $guides->shared_memo }}</textarea>
                      </div>
                  </div>
              　</div>
            </div>
            <button type="submit" class="btn blue-gradient btn-block col-sm-4 mx-auto d-block">更新する</button>
        </form>
    　　</div>
    </div>
    </div>
    <script> 
        var x = 1;
        var y = 1;
        var z = 1;
        function addPlan(){
            //ルート要素を取得
            let box = document.getElementById("planbox");
            //コピーしたい要素取得
            let planbox = document.getElementById("planbox_0");
            //「boxes」の要素の先頭にある子要素を複製（コピー）
            let clone = planbox.cloneNode(true);
            //クローンした要素にidを付ける
            clone.id = "planbox_"　+ x++;
            //×ボタンに対してidを付ける
            clone.querySelector('#deleteBtn_0').id = "deleteBtn_" + y++;
            //プランの最初に×ボタンを表示させない
            clone.querySelector('.delete_btn').hidden = false;
            //カテゴリーのname属性設定
            for($a=0; $a < 7; $a++){
                clone.querySelector('#category').name = 'category_' + z;
            }
            z++;

            //入力値をリセット
            let resetInput = clone.getElementsByClassName('reset');
            for(i=0; i < resetInput.length; i++){
                resetInput[i].value = '';
            }
            //「boxes」の要素の最後尾に複製した要素を追加
            box.appendChild(clone);
        }

        function deletePlan(id){
            //_以降の番号を取得
            var index = id.indexOf("_");
            var number = id.slice(index+1);
            var delPlan = document.getElementById("planbox_" + number);
            delPlan.remove();
	    }
        
    </script>
  @endsection