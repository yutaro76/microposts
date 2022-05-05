@extends('layouts.app')

@section('content')

    <p>退会するとアカウントが削除されます。</p>
    <p>ツイートやユーザも確認できなくなりますのでご了承ください。</p>
    
    {!! link_to_route('deleteAccount.get', 'アカウント削除', ['id' => Auth::id()], ['class' => 'btn btn-lg btn-danger']) !!}
    
@endsection