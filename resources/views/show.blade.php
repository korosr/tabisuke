@extends('layouts.app')
@section('title', 'tabisuke～快適な旅をサポート～ | 旅の詳細')
@section('content')
@include('nav')
<div class="container-fluid">
   <div class="m-5">
        <div class="mx-auto" style="max-width:1200px">
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/flag.png') }}" alt="旗画像" class="rounded-circle" width="100" height="100">
            </div>
            <div class="align-items-center justify-content-center mb-5" id="top_image">
                <p style="color:#555555; text-align:center; font-size:2.0em; font-weight:bold;">{{$plan_guide[0]->title}}</p><br>
                <p style="color:#555555; text-align:center; font-size:1.0em; font-weight:bold;">{{$plan_guide[0]->sub_title}}</p>
            </div>
            <div class="">
               <div class="d-flex flex-row flex-wrap">
                   <table class="table">
                        @foreach($plan_day as $pd)
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="3" class="text-center">{{$pd}}</th>
                                </tr>
                            </thead>
                            @foreach($plans as $plan)
                            <tr>
                                @if($pd === $plan->ymd)
                                    <td style="width:15%"><div class="text-center">{{$plan->hm}}</div></td>
                                    <td style="width:20%">{{$plan->category_name}}</td>
                                    <td style="width:65%">
                                        <p>{{$plan->plan_title}}<p>
                                        <p class="ml-4">{{$plan->contents}}</p>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        @endforeach
                   </table>
               </div>
            </div>
            <div class="card border-light my-5">
                <div class="card-header">MEMO</div>
                <div class="card-body">
                    <p class="card-text">{{$plan_guide[0]->shared_memo}}</p>
                </div>
            </div>
            <div class="justify-content-center row">
                <div class="mx-4">
                    <a href="{{ route('guides.edit', ['guide'=> $plan_guide[0]->id]) }}" class="stretched-link">編集する</a>
                </div>
                <div class="mx-4">
                    <form method="POST" name="delete_link" action="{{ route('guides.delete', ['guide'=> $plan_guide[0]->id]) }}">
                        @csrf
                        <a onclick="document.delete_link.submit();" class="stretched-link delete_link" style="color:#007bff;">削除する</a>
                    </form>
                </div>
            </div>
            <div class="text-center my-4">
                <a href="{{ route('guides.index') }}" class="stretched-link px-4">一覧に戻る</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                削除しますか？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                <button type="submit" class="btn btn-success" id="deletebtn" name="deletebtn" >はい</button>
            </div>
        </div>
    </div>
</div>
@endsection