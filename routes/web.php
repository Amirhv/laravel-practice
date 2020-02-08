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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Testing one to many relationship
/*
   Route::get('/all-posts',function (){
   $user = \App\User::find(1);
   $user->posts;
   foreach ($user->posts as $post){
       echo $post->title;
       echo "<br>";
       echo $post->description;
       echo "<br>";
    }
});
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/post', 'PostController')->middleware(['auth','verified']);

Route::get('/admin' , function (){
    echo 'welcome to admin page';
})->middleware('isAdmin');


