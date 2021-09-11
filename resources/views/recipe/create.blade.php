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
        <h3 class="middle-title">レシピ登録</h3>
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">レシピ名</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="introduction">レシピ紹介</label>
                <input type="text" class="form-control" name="introduction" id="introduction">
            </div>
         </div>
        <div class="col-md-5">
            <label for="time">所要時間（分）</label>
        </div>
        <div class="col-md-2">
            <select class="form-control" type="text" class="form-control" name="time" id="time">
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>40</option>
                <option>50</option>
                <option>60</option>
            </select>
        </div>
        <div class="pt-3">
            <h2>写真</h2>
        </div>
        <div class="col-md-11">
            <div>
                <h5 class="middle-title">豆の種類</h5>
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
                <h5 class="middle-title">抽出器具</h5>
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
            <div>
                <h5 class="middle-title">作り方</h5>
                <div class="form-group">
                    <label for="name">手順1</label>
                    <input type="text" class="form-control" name="processes[0]" id="processes[0]">
                </div>
                <div class="form-group">
                    <label for="name">手順2</label>
                    <input type="text" class="form-control" name="processes[1]" id="processes[1]">
                </div>
                <div class="form-group">
                    <label for="name">手順3</label>
                    <input type="text" class="form-control" name="processes[2]" id="processes[2]">
                </div>
                <div class="form-group">
                    <label for="name">手順4</label>
                    <input type="text" class="form-control" name="processes[3]" id="processes[3]">
                </div>
                <div class="form-group">
                    <label for="name">手順5</label>
                    <input type="text" class="form-control" name="processes[4]" id="processes[4]">
                </div>
            </div>
            <input type="submit" value="登録する" class="btn btn-secondary">
        </div>
    </form>
</div>
@endsection