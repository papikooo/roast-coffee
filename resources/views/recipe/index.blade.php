@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>レシピ検索ページ</h1>
    </div>
    <form action="/recipe/search" method="post">
        @csrf
        <h3>レシピ検索項目</h3>
        <div>
            <h5 class="middle-title">豆で探す</h5>
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
            <h5 class="middle-title">道具で探す</h5>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tools[0]" value="サイフォン" id="siphon">
                <label class="form-check-label" for="siphon">サイフォン</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tools[1]" value="フレンチプレス" id="french-press">
                <label class="form-check-label" for="french-press">フレンチプレス</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tools[2]" value="エアロプレス" id="aero-press">
                <label class="form-check-label" for="aero-press">エアロプレス</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tools[3]" value="エスプレッソ" id="espresso">
                <label class="form-check-label" for="espresso">エスプレッソ</label>
            </div>
        </div>
    </form>
    <div class="pt-4 row">
        @foreach($recipes as $recipe)
        <div class="p-2">
            <div class="card ori-border" style="width: 20rem;">
                <div class="card-body">
                    <p class="card-title">{{$recipe->name}}</p>
                    <p class="card-text normal-font">{{$recipe->introduction}}</p>
                    <a href="/recipe/detail/{{$recipe->id}}" class="btn btn-secondary">見る</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection