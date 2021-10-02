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
    
    <form action="/recipe/store" method="post" enctype="multipart/form-data">
        @csrf
        <h3 class="middle-title">レシピ登録</h3>
        <div class="mx-auto" style="width: 90%">
            <div>
                <div class="form-group">
                    <label for="name">レシピ名</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="introduction">レシピ紹介</label>
                    <input type="text" class="form-control" name="introduction" id="introduction">
                </div>
             </div>
            <div>
                <label for="time">所要時間（分）</label>
                <div class="w-25">
                    <select class="form-control" type="text" class="form-control" name="time" id="time">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                        <option>60</option>
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
                        <input class="custom-control-input" type="checkbox" name="beans[0]" value="キリマンジャロ" id="kilimanjaro">
                        <label class="custom-control-label" for="kilimanjaro">キリマンジャロ</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="beans[1]" value="モカ" id="mocha">
                        <label class="custom-control-label" for="mocha">モカ</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="beans[2]" value="マンデリン" id="mandheling">
                        <label class="custom-control-label" for="mandheling">マンデリン</label>
                    </div>
                </div>
            </div>
            <div>
                <h5 class="pt-3 middle-title">抽出器具</h5>
                <div class="row pl-3">
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[0]" value="サイフォン" id="siphon">
                        <label class="custom-control-label" for="siphon">サイフォン</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[1]" value="フレンチプレス" id="french-press">
                        <label class="custom-control-label" for="french-press">フレンチプレス</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[2]" value="エアロプレス" id="aero-press">
                        <label class="custom-control-label" for="aero-press">エアロプレス</label>
                    </div>
                    <div class="custom-control custom-checkbox col-6 col-md-3">
                        <input class="custom-control-input" type="checkbox" name="tools[3]" value="エスプレッソ" id="espresso">
                        <label class="custom-control-label" for="espresso">エスプレッソ</label>
                    </div>
                </div>
            </div>
            <div id="add">
                <div class="row">
                    <div class="col-7">
                        <h5 class="pt-3 middle-title">作り方</h5>
                        <div class="form-group">
                            <label for="name">手順1</label>
                            <input type="text" class="form-control" name="processes[0]" id="processes[0]">
                        </div>
                    </div>
                    <div class="col-5">
                        <h5 class="pt-3 middle-title">memo</h5>
                        <div class="form-group">
                            <label for="name">メモ</label>
                            <input type="text" class="form-control" name="memos[0]" id="memos[0]">
                        </div>
                    </div>
                </div>
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
    var process_num = 1;
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