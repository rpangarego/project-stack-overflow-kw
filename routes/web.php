<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

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

// Route halaman utama
Route::get('/', function(){
    return view('welcome');
});

Route::get('/profil', function(){
    $user = User::find(Auth::id());
    return view('user', compact('user'));
});

// Route PertanyaanController
Route::get('/pertanyaan', function () {
    return view('pertanyaan.index');
});

Route::resource('pertanyaan', 'ForumPertanyaanController');
Route::resource('komentarpertanyaan', 'ForumKomentarPertanyaanController');
Route::get('/pertanyaanku', 'ForumPertanyaanController@pertanyaanku');
Route::get('/pertanyaan/{pertanyaan}/komentarpertanyaan', 'ForumKomentarPertanyaanController@show');
Route::get('/pertanyaan/{pertanyaan}/komentarpertanyaan/create', 'ForumKomentarPertanyaanController@create');
Route::post('/pertanyaan/{pertanyaan}/komentarpertanyaan', 'ForumKomentarPertanyaanController@store');
Route::delete('/pertanyaan/{pertanyaan}/komentarpertanyaan', 'ForumKomentarPertanyaanController@destroy');
Route::resource('jawaban', 'ForumJawabanController');
Route::put('jawaban/{jawaban}', 'ForumJawabanController@update');
Route::put('/jawabanTepat/{jawaban}', 'ForumJawabanController@correctAnswer');

// Route Komentar
Route::resource('komentarjawaban', 'ForumKomentarJawabanController');
Route::get('/pertanyaan/{pertanyaan}/jawaban/{jawaban}/komentarjawaban', 'ForumKomentarJawabanController@show');

// Route Auth
Auth::routes();
Route::get('/home' , 'HomeController@index')->name('home');

// Route Vote Pertanyaan
Route::post('/upvote/pertanyaan', 'VotePertanyaanController@upvote');
Route::post('/downvote/pertanyaan', 'VotePertanyaanController@downvote');

// Route Middleware Laravel File Manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
