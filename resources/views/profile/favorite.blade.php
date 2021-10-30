@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-4">
        <span class="fa-stack fa-lg">
            <i class="fas fa-square fa-stack-2x blown"></i>
            <i class="fas fa-mug-hot fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="middle-title pt-2">お気に入り</h4>
    </div>
    <div class="pt-2 row">
        @foreach($favorites as $favorite)
        <div class="p-2">
            <div class="card ori-border" style="width: 20rem;">
                <div class="card-body">
                    <p class="card-title">{{$favorite->detail->name}}</p>
                    <p class="card-text normal-font">{{$favorite->detail->introduction}}</p>
                    @foreach($favorite->beans as $bean)
                        <span class="badge badge-primary">{{$bean->name}}</span>
                    @endforeach
                    <div class="pt-2 text-center">
                        <a href="/recipe/detail/{{$favorite->recipe_id}}" class="btn btn-primary">見る</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection