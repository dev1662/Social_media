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

use App\Events\FollowEvent;
use App\Events\TaskEvent;
use App\Http\Controllers\followsController;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('event', function(){
    event(new TaskEvent('hello how are you'));
});

Route::get('listen', function(){
    return view('ListenBroadcast');
});


Route::get('/email', function(){
    return new NewUserWelcomeMail();
});
Route::post('/saveLike', 'PostsController@saveLike');
// Route::post('/savecomment', 'PostsController@savecomment');

Route::get('/notification/get', 'NotificationController@get');
// Route::get('/likenotify/get', 'NotificationController@getlikes');

Route::post('/notification/read', 'NotificationController@read');




Route::post('/follow/{user}', 'followsController@store');
Route::get('/', 'PostsController@index');
// Route::get('/c', 'CommentController@create');
Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::get('/comment/{comments}', 'CommentController@show');
Route::get('/comment/{comments}/delete', 'CommentController@destroy');
// Route::get('/comment/{comments}', 'CommentController@show');

Route::get('/p/create', 'PostsController@create');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');
Route::get('/p/{post}/delete', 'PostsController@destroy');


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

