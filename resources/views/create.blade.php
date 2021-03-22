@extends('layouts.app')

@section('content')
@include('nav')
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/plane.png') }}" alt="しおり画像" class="rounded-circle" width="100" height="100">
            </div>    
            <h4 class="text-center m-3 text-muted">旅のタイトル</h4>
            <div class="card mt-3">
              <div class="card-body pt-0">
                <div class="card-text  p-3">
                  <form method="POST" action="">
                    @csrf    
                    <div class="md-form">
                        <label>タイトル</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                    </div>
                    <div class="md-form">
                        <label>サブタイトル</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
                    </div>
                </div>
            　</div>
            </div>
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/calendar.png') }}" alt="プラン画像" class="rounded-circle" width="100" height="100">
            </div> 
            <h4 class="text-center m-5 text-muted">プラン</h4>
            <div  id="planbox">
                <div class="card mt-3 mb-3">
                    <div class="card-body pt-0">
                    <div class="card-text  p-3">
                        <div class="form-group row">
                            <div class="input-group date col-sm-3" id="datePicker" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#datePicker" placeholder="日付を入力"/>
                            <div class="input-group-append" data-target="#datePicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                            <div class="input-group date col-sm-3" id="timePicker" data-target-input="nearest">
                                <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#timePicker" placeholder="時間を入力"/>
                                <div class="input-group-append" data-target="#timePicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" required value="{{ old('title') }}" placeholder="タイトル">
                        </div>
                        <div class="form-group">
                            <textarea name="contents" class="form-control" required value="{{ old('contents') }}" placeholder="内容"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="btn-group dropright col-sm-2">
                                <button class="btn btn-info dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                カテゴリー
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    @foreach($categories as $category)
                                    <button class="dropdown-item" type="button" id="{{$category -> id}}"><span class="text-muted">{{$category -> category_name}}</span></button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col justify-content-end align-self-center" id="deletebtn">
                                <i class="fas fa-trash-alt fa-2x float-right"></i>
                            </div>
                        </div>                     
                    </div>
                　</div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-info waves-effect" id="addbutton"><i class="fas fa-plus mx-1"></i>プラン追加</button>
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/book.png') }}" alt="その他画像" class="rounded-circle" width="100" height="100">
            </div> 
            <h4 class="text-center m-5 text-muted">共有事項</h4>
            <div class="card m-3">
                <div class="card-body pt-0">
                  <div class="card-text  pt-3">
                    <form method="POST" action="">
                      @csrf    
                      <div class="form-group">
                        <textarea name="contents" class="form-control" required value="{{ old('contents') }}" placeholder="内容" rows="4"></textarea>
                    </div>
                  </div>
              　</div>
            </div>
            <button type="submit" class="btn blue-gradient btn-block col-sm-4 mx-auto d-block">作成する</button>
            </form>
    　　　</div>
        </div>
    </div>
    <script>
        //idが「addbutton」の要素を取得
        let addbutton = document.getElementById("addbutton");

        //ボタンをクリックしたときに実行(イベントリスナー使用：ie9は以上で動作)
        addbutton.addEventListener("click", function(){
            //idが「boxes」の要素を取得
            let boxes = document.getElementById("planbox");

            //「boxes」の要素の先頭にある子要素を複製（コピー）
            let clone = boxes.firstElementChild.cloneNode(true);

            //「boxes」の要素の最後尾に複製した要素を追加
            boxes.appendChild(clone); 
        });

        //idが「deletebtn」の要素を取得
        let deletebutton = document.getElementById("deletebtn");
        deletebutton.addEventListener("click", function(){
            let boxes = document.getElementById("planbox");
            boxes.remove();
        });
    </script>
  @endsection
