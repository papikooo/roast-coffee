@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-3 float-right"> 
        <div class="list-group text-center font-weight-bold" style="font-size: 18px">
            <a href="#" class="list-group-item list-group-item-action">レシピを探す</a>
            <a href="#" class="list-group-item list-group-item-action">レシピを投稿する</a>
            <a href="#" class="list-group-item list-group-item-action">未定</a>
            <a href="/profile/{{$user->id}}" class="list-group-item list-group-item-action">マイページ</a>
        </div>
    </div>
    <div>
        <h1>Roast Coffee</h1>
    </div>
    <img src="/images/coffee-top.jpg"/>
    <div>
        <h2>新着レシピ</h2>
    </div>
    <div>
        <h2>レシピを探す</h2>
    </div>
</div>
@endsection