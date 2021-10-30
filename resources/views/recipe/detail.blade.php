@extends('layouts.app')

@section('content')

<div class="container">
     <div class="pt-3 row">
        <div class="col-md-6">
            <h2 class="title">{{$recipe->name}}</h2>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="col-md-2">
                <img src="{{ $recipe->user_image }}" class="w-100">
            </div>
            <div class="col-md-10">
                <h5>投稿者：{{$recipe->user_name}}さん</h5>
            </div>
        </div>
    </div>
    <div class="row">
        @isset($favorite)
        <a href="/favorite/delete/{{$recipe->id}}">
            <span class="fa-stack fa-lg btn">
                <i class="fas fa-square fa-stack-2x text-primary"></i>
                <i class="fas fa-mug-hot fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        @else
        <a href="/favorite/add/{{$recipe->id}}">
            <span class="fa-stack fa-lg btn">
                <i class="fas fa-square fa-stack-2x text-secondary"></i>
                <i class="fas fa-mug-hot fa-stack-1x fa-inverse"></i>
            </span>
        </a>
        @endisset
        <p class="pt-2">お気に入り</p>
    </div>
    <div class="pt-4 row">
        <div class="col-md-5">
            <div>
                <img src="{{ $recipe->thumbnail }}" class="w-100">
            </div>
                <div class="pl-3 pt-3 ori-border">
                    <h4 class="middle-title">レシピ紹介</h4>
                    <p class="normal-font">{{$recipe->introduction}}</p>
                </div>
        </div>
        <div class="mt-3 mx-3 col-md-6 ori-border">
             <div class="pt-3">
                <h4 class="middle-title">所要時間</h4>
                <p class="normal-font">{{$recipe->time}}分</p>
            </div>
             <div>
                <h4 class="middle-title">豆の種類</h4>
                <p class="normal-font">@foreach($beans as $bean)
                    ・{{$bean->name}}<br>
                @endforeach</p>
            </div>
            <div>
                <h4 class="middle-title">使う道具</h4>
                <p class="normal-font">@foreach($tools as $tool)
                    ・{{$tool->name}}<br>
                @endforeach</p>
            </div>
        </div>
    </div>
    <div class="pt-5">
        <h4 class="middle-title">焙煎手順</h4>
    </div>
    <div class="row">
        @foreach($processes as $process)
        <div class="p-2">
            <div class="card ori-border" style="width: 20rem;">
                <div class="card-body">
                    <p class="card-title">{{$process->process_num}}. {{$process->action}}</p>
                </div>
                <div class="card-body">
                    <p class="card-text normal-font">{{$process->memo}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(auth()->id() === $recipe->user_id)
        <div style="text-align: center">
            <a href="/recipe/edit/{{$recipe->id}}" class="btn btn-primary">編集</a>
        </div>
    @endif
    <hr size="10">
    <div class="pt-2">
        <h5 class="middle-title">コメント</h5>
    </div>
    @foreach($reports as $report)
    <div class="card mt-4">
        <div class="card-body">
            <p>{{$report->user_name}}</p>
            <p>{{$report->comment}}</p>
        </div>
    </div>
    @endforeach
    <hr size="10">
    <form action="/recipe/report/{{$recipe->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mx-auto" style="width: 70%">
            <div>
                <div class="form-group">
                    <label for="comment">コメント</label>
                    <input type="text" class="form-control" name="comment" id="comment">
                </div>
             </div>
            <div class="pt-4">
                <input type="submit" value="コメントする" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
@endsection