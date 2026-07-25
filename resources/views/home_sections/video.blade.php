@if(isset($videoSection) && $videoSection->is_active)
    <section class="video-section">
        <!-- მარცხენა ტექსტური ბლოკი -->
        <div class="video-section__content">
            <div class="video-section__bg-map"></div>
            <div class="video-section__text-wrapper">
                <h2 class="video-section__title">
                    {{ $videoSection->getTranslation('title') }}
                </h2>
                <p class="video-section__text">
                    {{ $videoSection->getTranslation('text') }}
                </p>
            </div>
        </div>

        <!-- მარჯვენა ნაწილი ვიდეოთი -->
        <div class="video-section__media">
            @php
                $videoPath = $videoSection->getTranslation('video_path');
                $posterPath = $videoSection->poster_path;
            @endphp

            <video class="video-section__video" id="promo-video" playsinline
                   @if($posterPath) poster="{{ asset($posterPath) }}" @endif>
                @if($videoPath)
                    <source src="{{ asset($videoPath) }}" type="video/mp4">
                @endif
                Your browser does not support the video tag.
            </video>

            <!-- ვიდეოს მართვის ღილაკი -->
            <button class="video-control-btn" id="video-control-btn" aria-label="Play video">
                <!-- აიქონი Play -->
                <svg class="icon-play" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <!-- აიქონი Pause -->
                <svg class="icon-pause" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
                <!-- აიქონი Replay -->
                <svg class="icon-replay" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                    <path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/>
                </svg>
            </button>
        </div>
    </section>
@endif
