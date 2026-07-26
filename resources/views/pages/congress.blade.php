@extends('layouts.app')
@section('content')
    <section class="about-hero about-main-banner">
        <div class="container">
            <h1 class="about-hero__title">
                {{ $congressPage?->getTranslation('title') ?? 'ჩვენს შესახებ' }}
            </h1>
            <h3 class="about-hero__subtitle">
                {{ $congressPage?->getTranslation('subtitle') ?? 'გაიცანით ჩვენი გუნდი. გაიგეთ მეტი ჩვენს შესახებ.' }}
            </h3>
        </div>
        <div class="about-hero__wave">
            <svg viewBox="0 0 1440 200" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,80 C350,140 600,180 900,160 C1200,140 1320,90 1440,110 L1440,200 L0,200 Z" fill="rgba(197, 31, 36, 0.6)"></path>
            </svg>
        </div>
    </section>
    @if($congressPage?->getTranslation('intro_text'))
        <section class="about-description">
            <div class="about-description__content">
                <p class="about-description__text">
                    {{ $congressPage->getTranslation('intro_text') }}
                </p>
            </div>
        </section>
    @endif
@endsection
