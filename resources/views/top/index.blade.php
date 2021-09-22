@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1 class="title">Roast Coffee</h1>
    </div>
    <div>
        <img src="/images/coffee-top.jpg" height="auto" width="100%"/>
    </div>
    <div class="pt-4">
        <form action="/recipe" method="get">
            @csrf
            <div class="text-center">
                <div class="pb-1">
                    <img src="/images/coffee-icon.png" alt=" " height="70px" width="70px"/>
                </div>
                <h3 class="middle-title">レシピを探す</h3>
            </div>
            <div class="mx-auto" style="width: 65%">
                    <div class="form-group">
                        <label for="name">キーワード検索</label>
                        <input type="text" class="form-control" name="keyword" id="keyword">
                    </div>
                    <div class="text-center">
                        <input type="submit" value="検索する" class="btn btn-primary">
                    </div>
            </div>
        </form>
    </div>
</div>
@endsection