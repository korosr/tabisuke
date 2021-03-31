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
                        @foreach($plans as $plan)
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" class="text-center">{{ $plan -> date_time -> format('Y年m月d日') }}</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>{{ $plan -> date_time -> format('H:i') }}</td>
                            <td>{{ $plan -> plan_title }}</td>
                        </tr>
                        @endforeach
                   </table>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection