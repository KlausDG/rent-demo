<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Resources\Game as GameResource;
use Illuminate\Http\Request;

class GameController extends Controller
{
    private $foreign_tables = ['language', 'genre', 'difficulty', 'filial'];

    public function index()
    {

    }

    public function admin($filial_id, $display_qtd, $sort_target, $sort_value, $available)
    {
        $games = Game::with($this->foreign_tables);

        if ($available != 'all') {
            $games = $games->availability($available);
        }

        if ($filial_id != "all") {
            $games = $games->filial($filial_id);
        }

        $games = $games->orderBy('isAvailable', 'DESC');
        $games = $games->orderBy($sort_target, $sort_value);

        //Debug
        // dd($games);
        // dd($games->toSql());

        if ($display_qtd === "todos") {
            $display_qtd = $games->count();
            $games = $games->paginate($display_qtd);
        } else {
            $games = $games->paginate($display_qtd);
        }
        $games->setPath('');
        return GameResource::collection($games);

    }

    public function search($filial_id, $display_qtd, $sort_target, $sort_value, $query)
    {
        $formatted_query = str_replace("%20", " ", $query);

        $games = Game::with($this->foreign_tables);
        if ($filial_id != 'all') {
            $games = $games->where([
                ['filial_id', '=', $filial_id],
                ['title', 'LIKE', '%' . $formatted_query . '%'],
            ]);
        } else {
            $games = $games->where('title', 'LIKE', '%' . $formatted_query . '%');
        }
        $games = $games->orderBy($sort_target, $sort_value);

        if ($display_qtd === "todos") {
            $display_qtd = $games->count();
            $games = $games->paginate($display_qtd);
        } else {
            $games = $games->paginate($display_qtd);
        }
        $games->setPath('');
        return GameResource::collection($games);

    }

    public function filter($filial_id, $display_qtd, $sort_target, $sort_value, $filter_player_qtd, $filter_language, $filter_difficulty, $filter_genre)
    {
        $qtd_operator = $qtd_value = $lang_operator = '';

        //Player Quantity Validation
        if ($filter_player_qtd == 0) {
            $qtd_operator = '>';
            $qtd_value = 0;
        } elseif ($filter_player_qtd == '6+') {
            $qtd_operator = '>=';
            $qtd_value = 6;
        } else {
            $qtd_operator = '=';
            $qtd_value = $filter_player_qtd;
        }
        //END of Player Quantity Validation

        //Language Validation
        $lang_operator = $filter_language == "0" ? ">=" : "=";
        //END of Language Validation

        $games = Game::with($this->foreign_tables);

        if ($filial_id != "all") {
            $games = $games->where([
                ['filial_id', '=', $filial_id],
                ['minPlayers', $qtd_operator, $qtd_value],
                ['languages_id', $lang_operator, $filter_language],
            ]);
        } else {
            $games = $games->where([
                ['minPlayers', $qtd_operator, $qtd_value],
                ['languages_id', $lang_operator, $filter_language],
            ]);
        }

        //Difficulties validation
        if ($filter_difficulty > 0) {
            $difficulties_array = explode(':', $filter_difficulty);

            if (count($difficulties_array) > 0) {
                $games = $games->where(function ($q) use ($difficulties_array) {
                    for ($i = 0; $i < count($difficulties_array); $i++) {
                        if ($i == 0) {
                            $q->where('difficulties_id', '=', $difficulties_array[$i]);
                        } else {
                            $q->orWhere('difficulties_id', '=', $difficulties_array[$i]);
                        }
                    }
                });
            }
        } else {
            $games->where('difficulties_id', '>=', 1);
        }
        //END of Difficulties validation

        //Genres Validation
        if ($filter_genre > 0) {
            $genres_array = explode(':', $filter_genre);
            if (count($genres_array) > 0) {
                $games = $games->where(function ($q) use ($genres_array) {
                    for ($i = 0; $i < count($genres_array); $i++) {
                        if ($i == 0) {
                            $q->where('genres_id', '=', $genres_array[$i]);
                        } else {
                            $q->orWhere('genres_id', '=', $genres_array[$i]);
                        }
                    }
                });
            }
        } else {
            $games->where('genres_id', '>=', 1);
        }
        //End of Genres Validation

        $games = $games->orderBy('isAvailable', 'DESC');
        $games = $games->orderBy($sort_target, $sort_value);

        // dd($games);
        // dd($games->toSql());

        if ($display_qtd === "todos") {
            $display_qtd = $games->count();
            $games = $games->paginate($display_qtd);
        } else {
            $games = $games->paginate($display_qtd);
        }
        return GameResource::collection($games);

    }

    public function store(Request $request)
    {
        // dd($request);
        $game = $request->isMethod('put') ? Game::findOrFail($request->id) : new Game;
        $game->title = $request->input('title');
        $game->minPlayers = $request->input('minPlayers');
        $game->maxPlayers = $request->input('maxPlayers');
        $game->minTime = $request->input('minTime');
        $game->maxTime = $request->input('maxTime');
        $game->isExpansion = $request->input('isExpansion');
        $game->isAvailable = $request->input('isAvailable');
        $game->price = $request->input('price');
        $game->description = $request->input('description');
        $game->imageThumb = $request->input('imageThumb');
        $game->difficulties_id = $request->input('difficulties_id');
        $game->genres_id = $request->input('genres_id');
        $game->languages_id = $request->input('languages_id');
        $game->languageObs = $request->input('languageObs');
        $game->filial_id = $request->input('filial_id');

        if ($game->save()) {
            return new GameResource($game);
        }
    }

    public function show($id)
    {
        // Get game
        $game = Game::findOrFail($id);

        // Return single game as resource
        return new GameResource($game);
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        $game->delete();
    }
}
