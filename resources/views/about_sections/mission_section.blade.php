@if($mission)
    <section class="about-founding about-founding--reverse">
        <div class="about-founding__container">
            <div class="about-founding__image-wrapper">
                <img src="{{ asset($mission->image) }}" alt="{{ $mission->getTranslation('title') }}" class="about-founding__image">
            </div>
            <div class="about-founding__content">
                <h2 class="about-founding__title">
                    {{ $mission->getTranslation('title') }}
                </h2>
                <p class="about-founding__text">
                    {!! nl2br(e($mission->getTranslation('content'))) !!}
                </p>
            </div>
        </div>
    </section>
@endif
