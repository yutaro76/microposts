@if (Auth::user()->being_favorite($micropost->id))
    {{--unfavorite--}}
    {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => "btn btn-success btn-sm"]) !!}
    {!! Form::close() !!}

@else   
    {{--favorite--}}
    {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-light btn-sm"]) !!}
    {!! Form::close() !!}
    
@endif