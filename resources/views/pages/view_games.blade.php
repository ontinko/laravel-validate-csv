@if(isset($errorMessage))
<div>{{errorMessage}}</div>
@elseif(isset($successMessage))
<div>{{successMessage}}</div>
@else

<form action="/validate" method="post" enctype="application/x-www-form-urlencoded">
    @csrf
    <div>
        <h3>Games</h3>
        <div>
            <button type="submit">Validate</button>
            <p>Please don't submit if page is still loading</p>
        </div>
    </div>
    <table>
        <tr>
            @foreach ($attr_names as $name)
            <th>{{$name}}</th>
            @endforeach
        </tr>
        @foreach ($games as $game_i => $game)
        <tr>
            @foreach ($game as $attr_i => $attr)
            <td>
                <input disabled type="text" name={{"games[]" .  $attr_names[$attr_i]}} value={{$attr}}>
            </td>
            @endforeach

        </tr>
        @endforeach
    </table>
</form>
@endif
