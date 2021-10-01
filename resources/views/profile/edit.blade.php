@extends('layouts.app')

@section('content')
<div class="container">
    <h1>マイページ編集</h1>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> 
    @endif
    
    <form action="/profile/update/{{$user->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="pb-1 form-group">
            <label for="name">ユーザー名</label>
            <input type="text" class="form-control" id="name" name="name" value={{$user->name}}>
        </div>
        <div>
            <input type="file" name="image">
        </div>
        <div class="pt-3 form-group">
            <label for="email">メールアドレス</label>
            <input type="text" class="form-control" id="email" name="email" value={{$user->email}}>
        </div>
        <div class="form-group">
            <label for="introduction">自己紹介</label>
            <input type="text" class="form-control" id="introduction" name="introduction" value={{$profile->introduction}}>
        </div>
        <div class="pt-2">
            <input type="submit" value="登録する" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection