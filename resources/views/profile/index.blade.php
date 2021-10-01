@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-3">
        <img src="{{ $profile->image }}" class="w-100">
    </div>
    <div>
        <h4 class="middle-title">ユーザー名：{{$user->name}}</h4>
    </div>
    <div>
        <h4 class="middle-title">お気に入り</h4>
    </div>
    <div>
        <h4 class="middle-title">自己紹介</h4>
        <p>{{$profile->introduction}}</p>
    </div>
    <a href="/profile/edit/{{$user->id}}">
        <input type="submit" value="編集する" class="btn btn-primary">
    </a>
</div>
@endsection