@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>レシピ検索ページ</h1>
    </div>
    <form action="/recipe" method="get">
        @csrf
        <h3 class="middle-title">レシピ検索項目</h3>
        <div class="mx-auto" style="width: 65%">
            <div>
                <div class="form-group">
                    <label for="name">キーワード検索</label>
                    <input type="text" class="form-control" name="keyword" id="keyword">
                </div>
                <input type="submit" value="検索する" class="btn btn-primary">
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
                    <a href="/recipe/detail/{{$recipe->id}}" class="btn btn-primary">見る</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection