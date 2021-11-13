<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "TopController@index");

Auth::routes();

//トップページ
Route::get('/top', "TopController@index");

//ユーザー登録
// Route::get('/user', "UserController@index"); //新規登録

Route::group(['middleware' => ['auth']], function () {
    //ユーザー情報編集
    Route::get('/profile/{id}', "ProfileController@index");//マイページ
    Route::get('/profile/edit/{id}', "ProfileController@edit"); //マイページ編集
    Route::post('/profile/update/{id}', "ProfileController@update");
    Route::get('/profile/favorite/{id}', "ProfileController@favorite");
    
    //レシピ
    Route::get('/recipe/create', "RecipeController@create");
    Route::post('/recipe/store', "RecipeController@store");
    Route::get('/recipe/edit/{recipe_id}', "RecipeController@edit");
    Route::post('/recipe/update/{recipe_id}', "RecipeController@update");
    Route::get('/recipe/delete/{recipe_id}', "RecipeController@delete");
    Route::post('/recipe/report/{recipe_id}', "RecipeController@report");
    
    //お気に入り
    Route::get('/favorite/add/{recipe_id}', "FavoriteController@add");
    Route::get('/favorite/delete/{recipe_id}', "FavoriteController@delete");
});

//レシピ
Route::get('/recipe', "RecipeController@index");
Route::get('/recipe/result', "RecipeController@index");
Route::get('/recipe/detail/{recipe_id}', "RecipeController@detail");

