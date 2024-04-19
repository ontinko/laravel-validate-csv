<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ValidateGamesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // all the validation is happening in the custom function, so no default rules
        return [];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            // the data is parsed as an array of associative arrays `games`
            $games = $validator->getData()['games'];

            // storing games with unique IDs in an associative array
            $games_cache = [];

            foreach ($games as $i => $game) {
                $game_id = $game['Game_Id'];
                // if the ID is unique, store in the cache and go the next game
                if (!array_key_exists($game_id, $games_cache)) {
                    $games_cache[$game_id] = $game;
                    continue;
                }

                // otherwise validate if game attributes differ from the first encounter's ones
                $duplicate = $games_cache[$game_id];

                // flag variable to only report an error for Game_Id once
                $id_reported = false;
                foreach ($game as $key => $attr) {
                    if ($key != 'Game_Id' && $attr != $duplicate[$key]) {
                        if (!$id_reported) {
                            $validator->errors()->add("games.$i.Game_Id", "All games with id of $game_id must have the same attributes");
                            $id_reported = true;
                        }
                        $validator->errors()->add("games.$i.$key", "All games with id of $game_id must have the same $key");
                    }
                }
            }
        });
    }
}
