@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.sidebar')
    
    <div>
        <h1>ユーザー名：{{$user->name}}</h1>
    </div>
    <div>
        <h2>写真</h2>
    </div>
    <div>
        <h4>お気に入り</h4>
    </div>
    <div>
        <h3>自己紹介<br>
        {{$profile->introduction}}</h3>
    </div>
    <a href="/profile/edit/{{$user->id}}">
        <input type="submit" value="編集する" class="btn btn-primary">
    </a>
</div>
@endsection