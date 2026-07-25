@extends('layouts.app')
@section('content')
    <main>
        @include('home_sections.hero')

        @include('home_sections.features')

        @include('home_sections.video')

        @include('home_sections.events')

        @include('home_sections.newsletter')
    </main>
@endsection
