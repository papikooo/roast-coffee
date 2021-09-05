@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>レシピ名：{{$recipe->name}}</h1>
    </div>
    <div>
        <h2>写真</h2>
    </div>
    <div>
        <h3>レシピ紹介<br>
        {{$recipe->introduction}}</h3>
    </div>
     <div>
        <h3>所要時間<br>
        {{$recipe->time}}</h3>
    </div>
     <div>
        <h3>豆の種類<br>
        @foreach($beans as $bean)
            {{$bean->name}}<br>
        @endforeach
        </h3>
    </div>
    <div>
        <h3>使う道具<br>
        @foreach($tools as $tool)
            {{$tool->name}}<br>
        @endforeach
        </h3>
    </div>
    <div>
        <h3>焙煎手順<br>
        @foreach($processes as $process)
            {{$process->action}}<br>
        @endforeach
        </h3>
    </div>
    
    <div>
        <h1>ユーザー名：{{$recipe->user_name}}</h1>
    </div>
    <div>
        <h2>写真</h2>
    </div>
</div>
@endsection