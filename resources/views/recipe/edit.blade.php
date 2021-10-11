@extends('layouts.app')

@section('content')

<div class="container">
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="/recipe/update/{{$recipe->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <h3 class="middle-title">レシピ登録</h3>
        <div class="mx-auto" style="width: 90%">
            <div>
                <div class="form-group">
                    <label for="name">レシピ名</label>
                    <input type="text" class="form-control" name="name" id="name" value={{$recipe->name}}>
                </div>
                <div class="form-group">
                    <label for="introduction">レシピ紹介</label>
                    <input type="text" class="form-control" name="introduction" id="introduction" value={{$recipe->introduction}}>
                </div>
             </div>
            <div>
                <label for="time">所要時間（分）</label>
                <div class="w-25">
                    <select class="form-control" type="text" class="form-control" name="time" id="time">
                        @for($i=10; $i<=60; $i+=10)
                            @if($i==$recipe->time)
                            <option selected>{{$i}}</option>//選択された時間の表示
                            @else
                            <option>{{$i}}</option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
            <div class="py-3">
                <h5 class="middle-title">写真</h5>
                <input type="file" name="image">
            </div>
            <div>
                <h5 class="pt-3 middle-title">豆の種類</h5>
                <div class="row pl-3">
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="beans[0]" value="キリマンジャロ" id="kilimanjaro"
                        @if($beans->contains('name', 'キリマンジャロ')) checked @endif>
                        <label class="custom-control-label" for="kilimanjaro">キリマンジャロ</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="beans[1]" value="モカ" id="mocha"
                        @if($beans->contains('name', 'モカ')) checked @endif>
                        <label class="custom-control-label" for="mocha">モカ</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="beans[2]" value="マンデリン" id="mandheling"
                        @if($beans->contains('name', 'マンデリン')) checked @endif>
                        <label class="custom-control-label" for="mandheling">マンデリン</label>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="pt-3 middle-title">抽出器具</h5>
                <div class="row pl-3">
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[0]" value="サイフォン" id="siphon"
                        @if($tools->contains('name', 'サイフォン')) checked @endif>
                        <label class="custom-control-label" for="siphon">サイフォン</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[1]" value="フレンチプレス" id="french-press"
                        @if($tools->contains('name', 'フレンチプレス')) checked @endif>
                        <label class="custom-control-label" for="french-press">フレンチプレス</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[2]" value="エアロプレス" id="aero-press"
                        @if($tools->contains('name', 'エアロプレス')) checked @endif>
                        <label class="custom-control-label" for="aero-press">エアロプレス</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[3]" value="エスプレッソ" id="espresso"
                        @if($tools->contains('name', 'エスプレッソ')) checked @endif>
                        <label class="custom-control-label" for="espresso">エスプレッソ</label>
                    </div>
                </div>
            </div>
            <div id="add">
                <div class="row">
                    <h5 class="pt-3 middle-title col-7">作り方</h5>
                    <h5 class="pt-3 middle-title col-5">memo</h5>
                </div>
                @foreach($processes as $key => $process)
                <div class="row">
                    <div class="col-7">
                        <div class="form-group">
                            <label for="name">手順{{$key+1}}</label>
                            <input type="text" class="form-control" name="processes[{{$key}}]" id="processes[{{$key}}]" value="{{$process->action}}">
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">メモ</label>
                            <input type="text" class="form-control" name="memos[{{$key}}]" id="memos[{{$key}}]" value="{{$process->memo}}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pt-2">
                <button type="button" class="btn btn-primary" onclick="addProcess()">+</button>
            </div>
            <div class="pt-3">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="public_status" value="2" id="public_status">
                    <label class="custom-control-label" for="public_status">このレシピを非公開にする</label>
                </div>
            </div>
            <div class="pt-4">
                <input type="submit" value="登録する" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
<script>
    var process_num = {{$processes->count()}};
    function addProcess(){
        let textbox_element = document.getElementById('add');
        var new_element = document.createElement('div');
        new_element.innerHTML = `
        <div class="row">
            <div class="col-7">
                <div class="form-group">
                    <label for="name">手順${process_num + 1}</label>
                    <input type="text" class="form-control" name="processes[${process_num}]" id="processes[${process_num}]">
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label for="name">メモ</label>
                    <input type="text" class="form-control" name="memos[${process_num}]" id="memos[${process_num}]">
                </div>
            </div>
        </div>
        `;
        textbox_element.appendChild(new_element);
        process_num++;
    }
</script>
@endsection