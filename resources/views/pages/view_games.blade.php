<head>
    <title>Games</title>
    <style>
        .container {
            width: 100%;
            display: flex;
            flex-direction: row;
        }

        .errorsContainer {
            border-style: solid;
            padding: 5px;
            margin: 5px;
            border-radius: 10px;
            border-color: red;
            border-width: 2px;
            min-width: 500px;
        }

        .errorInput {
            color: red;
        }
    </style>
</head>

<div>
    @if(isset($errorMessage))
    <h3>{{$errorMessage}}</h3>
    @else

    @if(session('successMessage'))
    <h3>{{session('successMessage')}}</h3>
    @endif

    <div class="container">
        @if (count($errors))
        <div class="errorsContainer">
            <h3>Errors:</h3>
            <ul>
                @foreach ($errors->all() as $err)
                <li>{{$err}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="/validate" method="post" enctype="application/x-www-form-urlencoded">
            @csrf
            <div>
                <a href="/upload">Back to upload page</a>
                <h3>Games</h3>
                <div>
                    <button type="submit">Validate</button>
                    <p>Please don't submit if the page is still loading</p>
                </div>
            </div>
            <table>
                <tr>
                    <th></th>
                    @foreach ($attr_names as $name)
                    <th>{{$name}}</th>
                    @endforeach
                </tr>
                @foreach ($games as $game_i => $game)
                <tr>
                    <th>{{$game_i + 1}}</th>
                    @foreach ($game as $attr_i => $attr)
                    <td>
                        <input readonly class="@error('games.' . $game_i . '.' . $attr_names[$attr_i]) errorInput @enderror" type="text" name="games[{{$game_i}}][{{$attr_names[$attr_i]}}]" value="{{ $attr }}">
                    </td>
                    @endforeach

                </tr>
                @endforeach
            </table>
        </form>
    </div>
    @endif
</div>
