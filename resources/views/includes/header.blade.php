<header class="header">
    <div class="header__wrap">
        <!-- ლოგო -->
        <a href="{{ route('home') ?? '/' }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo__img">
            <div class="logo__text">
                <span class="logo__title">Georgian Worldwide Congress</span>
                <span class="logo__subtitle">ქართველთა მსოფლიო კონგრესი</span>
            </div>
        </a>

        <!-- ნავიგაცია -->
        <nav class="header__nav">
            <ul class="navigation__list">
                @foreach($menuItems as $item)
                    @php
                        $isActive = request()->is(ltrim($item->url, '/')) || request()->url() == url($item->url);
                        $hasChildren = $item->children->isNotEmpty();
                    @endphp

                    <li class="{{ $hasChildren ? 'dropdown' : '' }}">
                        <a href="{{ $item->url ?? '#' }}"
                           class="navigation__link {{ $isActive ? 'navigation__link--active' : '' }} {{ $hasChildren ? 'dropdown-toggle' : '' }}"
                           @if($item->target_blank) target="_blank" rel="noopener noreferrer" @endif>
                            {{ $item->translated_title }}
                        </a>

                        @if($hasChildren)
                            <ul class="dropdown-menu">
                                @foreach($item->children as $child)
                                    <li>
                                        <a href="{{ $child->url }}"
                                           class="dropdown-item"
                                           @if($child->target_blank) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $child->translated_title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- მარჯვენა ნაწილი -->
        <div class="header__right">
            <div class="header__top-bar">
                <div class="header__socials">
                    @foreach($socialLinks as $social)
                        <a href="{{ $social->url }}" class="header__social-link" target="_blank" rel="noopener noreferrer">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    @endforeach
                </div>
                <span class="header__divider">|</span>
                <div class="header__lang">
                    <button class="header__lang-toggle" aria-label="Language">
                        <i class="fas fa-globe"></i>
                    </button>
                    <ul class="header__lang-dropdown">
                        @foreach($languages as $lang)
                            <li>
                                <a href="{{ route('lang.switch', $lang->code) }}"
                                   class="header__lang-item {{ app()->getLocale() === $lang->code ? 'active' : '' }}">
                                    {{ $lang->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="header__action">
                <a href="#" class="btn btn--outline">შესვლა</a>
            </div>
        </div>

        <!-- ბურგერ-მენიუ -->
        <button class="header__burger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
