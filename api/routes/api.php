<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;


//USER
// Add new User
Route::post('socio', 'UserController@store');
// Edit user
Route::put('socio', 'UserController@store');


//AUTH
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    
    Route::get('me', 'MeController');

});

//GAMES
// List games
Route::get('games/filial/{filial_id}/display={display_qtd}', 'GameController@index');

// List filtered games
Route::get('games/filial/{filial_id}/sort/{display_qtd}&{sort_target}&{sort_value}/filter/{filter_player_qtd}&{filter_language}&{filter_difficulty}&{filter_genre}', 'GameController@filter');

// Search
Route::get('games/filial/{filial_id}/sort/{display_qtd}&{sort_target}&{sort_value}/search/{query}', 'GameController@search');

// List single game
Route::get('game/{id}', 'GameController@show');

// Create new game
Route::post('game', 'GameController@store');

// Update game
Route::put('game', 'GameController@store');

// Delete game
Route::delete('game/{id}', 'GameController@destroy');


//OTHER
// List filials
Route::get('filials', "FilialController@index");

// List single filial
Route::get('filial/{id}', 'FilialController@show');

// Create new filial
Route::post('filial', 'FilialController@store');

// List difficulties
Route::get('difficulties', "DifficultyController@index");

// List single difficulty
Route::get('difficulty/{id}', 'DifficultyController@show');

// Create new difficulty
Route::post('difficulty', 'DifficultyController@store');

// Edit difficulty
Route::put('difficulty', 'DifficultyController@store');

// Remove difficulty
Route::delete('difficulty/{id}', 'DifficultyController@destroy');


// List genres
Route::get('genres', "GenreController@index");

// List single genre
Route::get('genre/{id}', 'GenreController@show');

// Create new genre
Route::post('genre', 'GenreController@store');

// List languages
Route::get('languages', "LanguageController@index");

// List single language
Route::get('language/{id}', 'LanguageController@show');

// Create new genre
Route::post('language', 'LanguageController@store');
