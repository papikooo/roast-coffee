@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>Roast Coffee</h1>
    </div>
    <div>
        <img src="/images/coffee-top.jpg" height="auto" width="100%"/>
    </div>
    @include('layouts.sidebar')
    <div>
        <h2>新着レシピ</h2>
    </div>
    <div>
        <h2>レシピを探す</h2>
    </div>
</div>
@endsection