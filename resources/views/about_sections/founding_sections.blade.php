@foreach($sections as $section)
    <section class="about-founding {{ $section->image_position === 'right' ? 'about-founding--reverse' : '' }}">
        <div class="about-founding__container">
            <div class="about-founding__image-wrapper">
                <img src="{{ asset($section->image) }}" alt="{{ $section->getTranslation('title') }}" class="about-founding__image">
            </div>
            <div class="about-founding__content">
                <h2 class="about-founding__title">
                    {{ $section->getTranslation('title') }}
                </h2>
                <p class="about-founding__text">
                    {!! nl2br(e($section->getTranslation('content'))) !!}
                </p>
            </div>
        </div>
    </section>
@endforeach
