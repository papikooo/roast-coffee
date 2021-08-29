@extends('layouts.app')

@section('content')

<div class="container">
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="/recipe/store" method="post">
        @csrf
        <h3>レシピ基本内容</h3>
        <div class="form-group">
            <label for="name">レシピ名</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="introduction">レシピ紹介</label>
            <input type="text" class="form-control" id="introduction" name="introduction">
        </div>
        <div class="form-group">
            <label for="time">所要時間</label>
            <input type="text" class="form-control" id="time" name="time">
        </div>
        <div>
            <h2>写真</h2>
        </div>
        <div>
            <h3>豆の種類</h3>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="beans[0]" value="キリマンジャロ" id="kilimanjaro">
                <label class="form-check-label" for="kilimanjaro">キリマンジャロ</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="beans[1]" value="モカ" id="mocha">
                <label class="form-check-label" for="mohca">モカ</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="beans[2]" value="マンデリン" id="mandheling">
                <label class="form-check-label" for="mandheling">マンデリン</label>
            </div>
        </div>
        <div>
            <h3>抽出器具</h3>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="siphon">
                <label class="form-check-label" for="siphon">サイフォン</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="french-press">
                <label class="form-check-label" for="french-press">フレンチプレス</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="aero-press">
                <label class="form-check-label" for="aero-press">エアロプレス</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="espresso">
                <label class="form-check-label" for="espresso">エスプレッソ</label>
            </div>
        </div>
         <div>
            <h3>作り方</h3>
            <div class="form-group">
                <label for="name">手順1</label>
                <input type="text" class="form-control" id="pro-1" name="pro-1">
            </div>
            <div class="form-group">
                <label for="name">手順2</label>
                <input type="text" class="form-control" id="pro-2" name="pro-2">
            </div>
            <div class="form-group">
                <label for="name">手順3</label>
                <input type="text" class="form-control" id="pro-3" name="pro-3">
            </div>
            <div class="form-group">
                <label for="name">手順4</label>
                <input type="text" class="form-control" id="pro-4" name="pro-4">
            </div>
            <div class="form-group">
                <label for="name">手順5</label>
                <input type="text" class="form-control" id="pro-5" name="pro-5">
            </div>
        </div>
        <input type="submit" value="登録する" class="btn btn-primary">
    </form>
</div>
@endsection