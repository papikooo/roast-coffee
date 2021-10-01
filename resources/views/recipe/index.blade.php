@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/recipe" method="get">
        @csrf
        <h3 class="middle-title">レシピを探す</h3>
        <div class="mx-auto" style="width: 65%">
            <div>
                <div class="form-group">
                    <label for="name">キーワード検索</label>
                    <input type="text" class="form-control" name="keyword" id="keyword" value="{{isset($keywords) ? implode(" ", $keywords) : ""}}">
                </div>
                <div class="text-center">
                    <input type="submit" value="検索する" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
    @isset($keywords)
    <div class="pt-5">
        <p class="middle-title normal-font">検索ワード：{{implode("　", $keywords)}}</p>
    </div>
    @endisset
    <div class="pt-2 row">
        @foreach($recipes as $recipe)
        <div class="p-2">
            <div class="card ori-border" style="width: 20rem;">
                <div class="card-body">
                    <p class="card-title">{{$recipe->detail->name}}</p>
                    <p class="card-text normal-font">{{$recipe->detail->introduction}}</p>
                    @foreach($recipe->beans as $bean)
                        <span class="badge badge-primary">{{$bean->name}}</span>
                    @endforeach
                    <div class="pt-2 text-center">
                        <a href="/recipe/detail/{{$recipe->id}}" class="btn btn-primary">見る</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection