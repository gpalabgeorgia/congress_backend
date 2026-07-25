@if($newsletterSection)
    <section class="newsletter-section">
        <div class="newsletter-container">
            <!-- კონვერტის აიქონი -->
            <div class="newsletter-icon-wrapper">
                <svg class="newsletter-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </div>

            <!-- სათაურები -->
            <h2 class="newsletter-title">
                {{ $newsletterSection->getTranslation('title') }}
            </h2>
            <p class="newsletter-subtitle">
                {{ $newsletterSection->getTranslation('subtitle') }}
            </p>

            <!-- გამოწერის ფორმა -->
            <form class="newsletter-form" id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                @csrf
                <div class="newsletter-input-group">
                    <input
                        type="email"
                        name="email"
                        class="newsletter-input"
                        placeholder="{{ $newsletterSection->getTranslation('placeholder_text') }}"
                        required
                        aria-label="Email address"
                    >
                </div>
                <button type="submit" class="newsletter-btn">
                    {{ $newsletterSection->getTranslation('button_text') }}
                </button>
            </form>
        </div>
    </section>
@endif
