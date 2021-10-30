@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-3">
        <img src="{{ $profile->image }}" class="w-100">
    </div>
    <div>
        <h4 class="middle-title">ユーザー名：{{$user->name}}</h4>
    </div>
    <div class="row pt-4">
        <a href="/profile/favorite/{{$user->id}}">
            <span class="fa-stack fa-lg">
                <i class="fas fa-square fa-stack-2x blown"></i>
                <i class="fas fa-mug-hot fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="middle-title pt-2">お気に入り</h4>
        </a>
    </div>
    <div class="pt-4">
        <h4 class="middle-title">自己紹介</h4>
        <p>{{$profile->introduction}}</p>
    </div>
    <div class="pt-4">
        <a href="/profile/edit/{{$user->id}}">
            <input type="submit" value="編集する" class="btn btn-primary">
        </a>
    </div>
    <div class="pt-4">
        <h4 class="middle-title">最近見たレシピ</h4>
    </div>
    <div class="pt-2 row">
        @foreach($histories as $history)
        <div class="p-2">
            <div class="card ori-border" style="width: 20rem;">
                <div class="card-body">
                    <p class="card-title">{{$history->detail->name}}</p>
                    <p class="card-text normal-font">{{$history->detail->introduction}}</p>
                    @foreach($history->beans as $bean)
                        <span class="badge badge-primary">{{$bean->name}}</span>
                    @endforeach
                    <div class="pt-2 text-center">
                        <a href="/recipe/detail/{{$history->recipe_id}}" class="btn btn-primary">見る</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection