@extends('layouts.main')

@section('title', $title ?? 'Test title')

@section('content')
    <h1> Home page </h1>

    @isset($users) <!--перевірка на існування змінної users-->
        @foreach($users as $user)
            {{ $user['name'] }} <br>
        @endforeach
    @endisset
@endsection

