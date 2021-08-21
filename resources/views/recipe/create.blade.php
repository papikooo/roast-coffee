@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.sidebar')
    
    <div>
        <h1>レシピ名</h1>
    </div>
    <div>
        <h2>写真</h2>
    </div>
    <div>
        <h4>お気に入り</h4>
    </div>
    <div>
        <h3>レシピ紹介</h3>
    </div>
    <div>
        <h3>豆の種類</h3>
        //チェックボックス　その他1 自由入力
    </div>
    <div>
        <h3>道具の種類</h3>
        //チェックボックス　その他1 自由入力
    </div>
     <div>
        <h3>作り方</h3>
    </div>
</div>
@endsection