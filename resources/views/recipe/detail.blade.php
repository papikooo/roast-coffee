@extends('layouts.app')

@section('content')

<div class="container">
     <div class="pt-3 row">
        <div class="col-md-6">
            <h2 class="title">{{$recipe->name}}</h2>
        </div>
        <div class="col-md-6 row">
            <div class="col-md-2">
                <h5>写真</h5>
            </div>
            <div class="col-md-10">
                <h5>{{$recipe->user_name}}さん</h5>
            </div>
        </div>
    </div>
    <div class="pt-4 row">
        <div class="col-md-5">
            <div>
                <h2>写真</h2>
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
                    <p class="card-text normal-font">メモ欄</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection