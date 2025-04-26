@extends('layouts.app')

@section('title', $book->title)
@section('content')
    @include('components.books.hero')
    @include('components.books.description')
    @include('components.books.about')
    @include('components.books.comunity')
    @include('components.books.join')
    @include('components.home.footer')
@endsection
