@extends('layouts.app')

@section('content')

<div class="container">
     <div style="text-align: center">
          <img src="/images/caution.png" height="180px" width="180px"/>
          <h1 class="font-color">ページが見つかりません</h1>
          <p class="middle-title" style="font-size: 20px">このレシピは削除されたか、投稿主により非公開になっています</p>
     </div>
     <div class="pt-4" style="text-align: center">
          <a href="/top" class="btn btn-primary">トップページに戻る</a>
     </div>
</div>
@endsection