<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

//AUTH
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');

    Route::get('me', 'MeController');

});

//USER
Route::group(['prefix' => 'users'], function () {
    //List all
    Route::get('all', 'UserController@index');
    // List single
    Route::get('usr={id}', 'UserController@show');
    // Add new
    Route::post('add', 'UserController@store');
    // Edit
    Route::put('edit', 'UserController@store');
    // Remove
    Route::delete('usr={id}', 'UserController@destroy');
});

//GAMES
Route::group(['prefix' => 'games'], function () {
    // Admin List all 
    Route::get('admin/filial={filial_id}/sort={display_qtd}&{sort_target}&{sort_value}/filter={available}', 'GameController@admin');

    // List filtered
    Route::get('filial={filial_id}/sort={display_qtd}&{sort_target}&{sort_value}/filter={filter_player_qtd}&{filter_language}&{filter_difficulty}&{filter_genre}', 'GameController@filter');
    // Search
    Route::get('filial={filial_id}/sort={display_qtd}&{sort_target}&{sort_value}/search={query}', 'GameController@search');
    // List single
    Route::get('game={id}', 'GameController@show');

    // Create new
    Route::post('add', 'GameController@store');
    // Edit
    Route::put('edit', 'GameController@store');
    // Delete
    Route::delete('destroy/{id}', 'GameController@destroy');
});

//FILIALS
Route::group(['prefix' => 'filials'], function () {
    // List all
    Route::get('all', "FilialController@index");
    // List single
    Route::get('fil={id}', 'FilialController@show');
    // Create new
    Route::post('add', 'FilialController@store');
    // Edit
    Route::put('edit', 'FilialController@store');
    // Remove
    Route::delete('fil={id}', 'FilialController@destroy');

});

//DIFFICULTIES
Route::group(['prefix' => 'difficulties'], function () {
    // List difficulties
    Route::get('all', "DifficultyController@index");
    // List single difficulty
    Route::get('dif={id}', 'DifficultyController@show');
    // Create new difficulty
    Route::post('add', 'DifficultyController@store');
    // Edit difficulty
    Route::put('edit', 'DifficultyController@store');
    // Remove difficulty
    Route::delete('dif={id}', 'DifficultyController@destroy');

});

//GENRES
Route::group(['prefix' => 'genres'], function () {
    // List genres
    Route::get('all', "GenreController@index");
    // List single genre
    Route::get('gen={id}', 'GenreController@show');
    // Create new genre
    Route::post('add', 'GenreController@store');
    // Edit genre
    Route::put('edit', 'GenreController@store');
    // Remove genre
    Route::delete('gen={id}', 'GenreController@destroy');
});

//LANGUAGES
Route::group(['prefix' => 'languages'], function () {
    // List all
    Route::get('all', "LanguageController@index");
    // List single
    Route::get('lang={id}', 'LanguageController@show');
    // Create new
    Route::post('add', 'LanguageController@store');
    // Edit
    Route::put('edit', 'LanguageController@store');
    // Remove
    Route::delete('lang={id}', 'LanguageController@destroy');

});
