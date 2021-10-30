<div class="list-group sidebar" style="font-size: 18px">
    <a href="/top" class="list-group-item list-group-item-action side-back">トップページ</a>
    <a href="/recipe" class="list-group-item list-group-item-action side-back">レシピを探す</a>
    <a href="/recipe/create" class="list-group-item list-group-item-action side-back">レシピを投稿する</a>
    @guest
    <a href="{{ route('login') }}" class="list-group-item list-group-item-action side-back">ログイン</a>
    @else
    <a href="/profile/{{auth()->id()}}" class="list-group-item list-group-item-action side-back">マイページ</a>
    @endguest
</div>