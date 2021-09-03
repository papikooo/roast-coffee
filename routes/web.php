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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//トップページ
Route::get('/top', "TopController@index");

//ユーザー登録
// Route::get('/user', "UserController@index"); //新規登録

//ユーザー情報編集
Route::get('/profile/{id}', "ProfileController@index"); //マイページ
Route::get('/profile/edit/{id}', "ProfileController@edit"); //マイページ編集
Route::post('/profile/update/{id}', "ProfileController@update");

//レシピ
Route::get('/recipe', "RecipeController@index");
Route::get('/recipe/create', "RecipeController@create");
Route::post('/recipe/store', "RecipeController@store");
Route::get('/recipe/detail/{recipe_id}', "RecipeController@detail");
Route::get('/recipe/edit/{recipe_id}', "RecipeController@edit");
Route::post('/recipe/update/{recipe_id}', "RecipeController@update");
Route::get('/recipe/delete/{recipe_id}', "RecipeController@delete");