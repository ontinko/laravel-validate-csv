<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateGamesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GamesController extends Controller
{
    public function create(): View
    {
        return view('pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // checking for validity of CSV file
        // if valid, store the file to local storage and redirect to validation
        $request->validate(['file' => 'required|file|mimes:csv']);

        $file = $request->file('file');
        Storage::disk('local')->put('games.csv', file_get_contents($file));
        return redirect('/validate');
    }

    // if the logic were more complex, I would probably move the code from this controller to a separate class/function
    // I decided to keep it all in the controller since the logic is pretty simple
    public function view_games(): View
    {
        if (!Storage::disk('local')->exists('games.csv')) {
            return view('pages.view_games')->with('errorMessage', 'File not found');
        }

        $file_data = fopen(storage_path() . '/app/games.csv', 'r');
        $games_data = [];

        // Storing attribute names (first line of CSV)
        $attr_names = fgetcsv($file_data);
        if (!$attr_names) {
            return view('pages.view_games')->with('errorMessage', 'File is empty');
        }

        // parses the data into a two-dimensional array
        while (!feof($file_data)) {
            $game_data = fgetcsv($file_data);
            // skip empty lines
            if (!$game_data) {
                continue;
            }
            $games_data[] = $game_data;
        }
        return view('pages.view_games')->with(['attr_names' => $attr_names, 'games' => $games_data]);
    }

    // using form request for validation
    public function validate_games(ValidateGamesRequest $request): RedirectResponse
    {
        return redirect()->back()->with(['successMessage' => 'All games are valid!']);
    }
}
