<?php 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
 
// Player

Route::get('/player', 'PlayerController@index')->name('player'); 

Route::resource('crud', 'PlayerController');

Route::get('/editplayer', 'PlayerController@edit')->name('editplayer');

Route::get('/addplayer', 'PlayerController@addplayer')->name('addplayer');
 

// Club

Route::get('/club', 'ClubController@index')->name('club');

Route::resource('clubcrud', 'ClubController');

Route::get('/editclub', 'ClubController@edit')->name('editclub');

Route::get('/addclub', 'ClubController@addclub')->name('addclub'); 


//Player_Cub

Route::resource('playerclub','PlayerClubController');