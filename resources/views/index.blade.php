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
<<<<<<< HEAD
=======
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
>>>>>>> 30d724d0412e4b7d9f1ff656da9cbb82c5e399e4
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