@if($activity)
    <section class="about-founding">
        <div class="about-founding__container">
            <div class="about-founding__image-wrapper">
                <img src="{{ asset($activity->image) }}" alt="{{ $activity->getTranslation('title') }}" class="about-founding__image">
            </div>
            <div class="about-founding__content">
                <h2 class="about-founding__title">
                    {{ $activity->getTranslation('title') }}
                </h2>
                <p class="about-founding__text">
                    {!! nl2br(e($activity->getTranslation('content'))) !!}
                </p>
            </div>
        </div>
    </section>
@endif
