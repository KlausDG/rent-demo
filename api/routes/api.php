<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;


//AUTH
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    
    Route::get('me', 'MeController');

});

//GAMES
// List games
Route::get('games/filial/{filial_id}/display={display_qtd}', 'GamesController@index');

// List filtered games
Route::get('games/filial/{filial_id}/sort/{display_qtd}&{sort_target}&{sort_value}/filter/{filter_player_qtd}&{filter_language}&{filter_difficulty}&{filter_genre}', 'GamesController@filter');

// Search
Route::get('games/filial/{filial_id}/sort/{display_qtd}&{sort_target}&{sort_value}/search/{query}', 'GamesController@search');

// List single game
Route::get('game/filial/{filial_id}/{id}', 'GamesController@show');

// Create new game
Route::post('game', 'GamesController@store');

// Update game
Route::put('game', 'GamesController@store');

// Delete game
Route::delete('game/{id}', 'GamesController@destroy');

//OTHER
// List filials
Route::get('filials', "FillialsController@index");
