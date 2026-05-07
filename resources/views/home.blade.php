@extends('layouts.app')

@section('title', 'Husein Alhafiz — Portfolio')
@section('description', 'Portfolio of Husein Alhafiz')

@section('content')
    @include('partials.hero')
    @include('partials.about')
    @include('partials.portfolio')
    @include('partials.education')
    @include('partials.experience')
    @include('partials.blog')
    @include('partials.contact')
@endsection

@push('scripts')
    <script>
        // Smooth scrolling back to top
        document.querySelector('.back-to-top').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
@endpush
