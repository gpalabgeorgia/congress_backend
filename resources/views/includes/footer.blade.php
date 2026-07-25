<footer class="main-footer">
    <div class="footer-wave-top">
        <svg viewBox="0 0 1440 140" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0 L0,80 Q720,-35 1440,80 L1440,0 Z" fill="#DB1B1B"/>
        </svg>
    </div>
    <div class="footer-wave-bottom">
        <svg viewBox="0 0 1440 140" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,140 L0,60 Q720,180 1440,60 L1440,140 Z" fill="#DB1B1B"/>
        </svg>
    </div>
    <div class="footer-container">
        <div class="footer-grid">

            <div class="footer-col footer-col-left">
                <div class="logo-wrapper">
                    <img src="{{ ($footerSetting && $footerSetting->logo_path) ? asset($footerSetting->logo_path) : asset('images/logo.png') }}" alt="Logo" class="footer-left-logo">
                    <div class="vertical-divider"></div>
                </div>
                <div class="copyright-box">
                    <p class="footer-text">
                        {{ $footerSetting ? $footerSetting->getTranslation('copyright_text') : 'Copyright © ' . date('Y') }}
                    </p>
                </div>
            </div>

            <div class="footer-col footer-col-center">
                <h3 class="footer-brand-title">
                    {{ $footerSetting ? $footerSetting->getTranslation('title') : 'ქართველთა მსოფლიო კონგრესი' }}
                </h3>

                {{-- Навигация из $menuItems --}}
                <nav class="footer-nav">
                    <ul class="footer-nav-list">
                        @foreach($menuItems as $item)
                            @if($item->children && $item->children->count() > 0)
                                <li class="dropdown">
                                    <a href="{{ $item->url ?? '#' }}" class="navigation__link dropdown-toggle" @if($item->target_blank) target="_blank" @endif>
                                        {{ $item->translated_title }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($item->children as $child)
                                            <li>
                                                <a href="{{ $child->url }}" class="dropdown-item" @if($child->target_blank) target="_blank" @endif>
                                                    {{ $child->translated_title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $item->url }}" class="footer-nav-link" @if($item->target_blank) target="_blank" @endif>
                                        {{ $item->translated_title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>

                <div class="header__social-link">
                    @foreach($socialLinks as $social)
                        <a href="{{ $social->url }}" class="header__social-link" target="_blank" rel="noopener noreferrer">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="footer-col footer-col-right">
                <div class="placeholder-wrapper"></div>
                <div class="developer-box">
                    <p class="footer-text">
                        {{ $footerSetting ? $footerSetting->getTranslation('developer_text') : 'Powered by' }}
                        <a href="{{ $footerSetting->developer_url ?? '#' }}" target="_blank" class="dev-link">GPALAB</a>
                    </p>
                </div>
            </div>
        </div>
        <img src="{{ asset('images/flags/worldMap.png') }}" alt="World Map" class="footer-bg-map">
    </div>
</footer>
