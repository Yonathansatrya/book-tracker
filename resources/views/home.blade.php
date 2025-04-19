@extends('layouts.app')

@section('content')
    @include('components.home.hero')
    @include('components.home.Carousel')
    @include('components.home.categories')
    @include('components.home.Author')
    @include('components.home.Testimonials')
    @include('components.home.footer')
@endsection
