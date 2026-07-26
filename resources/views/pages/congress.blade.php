@extends('layouts.app')
@section('content')
    @include('about_sections.hero_section')

    @if($sections->isNotEmpty())
        @include('about_sections.founding_sections')
    @endif

    @include('about_sections.mission_section')
@endsection
