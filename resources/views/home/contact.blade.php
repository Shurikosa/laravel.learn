@extends('layouts.main')<!-- тут вказується залежність до шаблону -->

@section('title', $title ?? 'Test title')
@section('content') <!-- тут вказується змінна яка буде доступна в шаблоні -->
<h1>Contact page</h1> {{-- так робляться коментарі в шаблонізаторі blade --}}
    @isset($users) <!--перевірка на існування змінної users-->
        @foreach($users as $user)
            Name: {{ $user['name'] }} <br>
            Phone:{{ $user['phone'] }} <br>
        @endforeach
    @endisset
@endsection

@section('navbar'){{-- тут ми знаходимо наш 'navbar' можемо його змінити, або не показувати... --}}
    @parent {{-- ця директива вказує що навбар має відображатись як в шаблоні --}}

@endsection


