@extends('layouts.app')
@section('content')
    <main>
        @include('home_sections.hero')

        @include('home_sections.features')

        @include('home_sections.video')

        @include('home_sections.events')

        <section class="newsletter-section">
            <div class="newsletter-container">
                <!-- კონვერტის აიქონი -->
                <div class="newsletter-icon-wrapper">
                    <svg class="newsletter-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <!-- სათაურები ქართულად -->
                <h2 class="newsletter-title">გამოიწერეთ ჩვენი გვერდი ყველა სიახლის მისაღებად</h2>
                <p class="newsletter-subtitle">
                    გამოიწერეთ ჩვენი გვერდი. შეიყვანეთ თქვენი ელექტრონული ფოსტის მისამართი და მიიღეთ ყველა სიახლე ელექტრონულ ფოსტაზე
                </p>
                <!-- გამოწერის ფორმა -->
                <form class="newsletter-form" id="newsletter-form">
                    <div class="newsletter-input-group">
                        <input
                            type="email"
                            class="newsletter-input"
                            placeholder="ელექტრონული ფოსტის მისამართი"
                            required
                            aria-label="Email address"
                        >
                    </div>
                    <button type="submit" class="newsletter-btn">გამოწერა</button>
                </form>
            </div>
        </section>
    </main>
@endsection
