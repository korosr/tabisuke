@extends('layouts.app')

@section('content')
@include('nav')
<div class="container-fluid">
   <div class="m-5">
        <div class="mx-auto" style="max-width:1200px">
            <div class="text-center m-5">
                <img src="{{ asset('/assets/images/shiori.png') }}" alt="しおり一覧画像" class="rounded-circle" width="100" height="100">
                <div style="color:#555555; text-align:center; font-size:1.5em; font-weight:bold;" class="mt-3">しおり一覧</div>
            </div>
            <div class="">
               <div class="d-flex flex-row flex-wrap">
                   <table class="table">
                        @foreach($plan_guide as $pg)
                            <tr>
                                <td style="width:15%"><div class="text-center">{{$pg->guide_date}}～</div></td>
                                <td style="width:40%">{{$pg->title}}</td>
                                <td style="width:10%"><a class="btn btn-info btn-sm" href="{{ route('guides.show', ['guide'=>$pg->id])}}" role="button">開く</a></td>
                            </tr>
                        @endforeach
                   </table>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection