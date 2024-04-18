<?php

namespace App\Http\Controllers;

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
        $request->validate(['file' => 'required|file|mimes:csv']);

        $file = $request->file('file');
        Storage::disk('local')->put('games.csv', file_get_contents($file));
        return redirect('/validate');
    }

    public function view_games(): View
    {
        if (!Storage::disk('local')->exists('games.csv')) {
            return view('pages.view_games')->with('errorMessage', 'File not found');
        }

        $file_data = fopen(storage_path() . '/app/games.csv', 'r');
        $games_data = [];
        $attr_names = fgetcsv($file_data);
        if (!$attr_names) {
            return view('pages.view_games')->with('errorMessage', 'File is empty');
        }

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

    public function validate_games(): RedirectResponse
    {
        return redirect('/upload');
    }
}
