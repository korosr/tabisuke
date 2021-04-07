@extends('layouts.app')

@section('content')
@include('nav')
<div class="container-fluid">
   <div class="m-5">
        <div class="mx-auto" style="max-width:1200px">
            <div class="d-flex align-items-center justify-content-center" id="top_image">
                <p style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">{{$plan_guide[0]->title}}</p><br>
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
                                @if($pd === $plan->date_time->format('Y年m月d日'))
                                    <td style="width:15%"><div class="text-center">{{$plan->date_time->format('H:i')}}</div></td>
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
            <div class="text-center">
                <button type="button" class="btn btn-primary">編集する</button>
                <button type="button" class="btn btn-primary">削除する</button>
                <button type="button" data-toggle="modal" data-target="#modal_delete" data-title="{{ $post->id }}" data-url="post/index">削除する</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modal_delete').on('shown.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var title = button.data('title');
      var url = button.data('url');
      var modal = $(this);
      modal.find('.modal-body p').eq(0).text(title);
      modal.find('form').attr('action',url);
    });
</script>
@endsection