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
                        <thead class="thead-light">
                            <tr>
                                <th colspan="2" class="text-center">yyyy/MM/dd</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>bbb</td>
                            <td>bbb</td>
                        </tr>
                   </table>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection