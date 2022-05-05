@extends('layouts.app')

@section('content')

    <h1>編集ページ</h1>
    
    <div class="row">
        <div class="col-6">
            {!! Form::model($micropost, ['route' => ['microposts.update', $micropost->id], 'method' => 'put']) !!}
            <input type="hidden" value="{{ $path }}" name="path"> 
            
                <div class="form-group">
                    {!! Form::label('content', 'Tweet：') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
            
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            
            {!! Form::close() !!}
        </div>
    </div>
    
@endsection