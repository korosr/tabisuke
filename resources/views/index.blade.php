@extends('layouts.app')

@section('content')
@include('nav')
<div class="container-fluid">
   <div class="m-3">
       <div class="mx-auto" style="max-width:1200px">
           <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">一覧を出す</h1>
           <div class="">
               <div class="d-flex flex-row flex-wrap">
                   <table class="table">
                        @foreach($plan_day as $pd)
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="4" class="text-center">{{ $pd }}</th>
                                </tr>
                            </thead>
                            @foreach($plans as $plan)
                            <tr>
                                @if($pd === $plan->date_time->format('Y年m月d日'))
                                <td style="width:15%"><div class="text-center">{{$plan->date_time->format('H:i')}}</div></td>
                                <td style="width:30%">{{$plan->category_name}}</td>
                                <td style="width:30%">{{$plan->plan_title}}</td>
                                <td style="width:30%">{{$plan->contents}}</td>
                                @endif
                            </tr>
                            @endforeach
                        @endforeach
                   </table>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection