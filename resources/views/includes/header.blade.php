<header class="header">
    <div class="header__wrap">
        <!-- ლოგო -->
        <a href="#" class="logo">
            <img src="images/logo.png" alt="Logo" class="logo__img">
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
                        // Проверяем, совпадает ли текущий URL с ссылкой пункта (для добавления класса active)
                        $isActive = request()->is(ltrim($item->url, '/')) || request()->url() == url($item->url);
                        $hasChildren = $item->children->isNotEmpty();
                    @endphp

                    <li class="{{ $hasChildren ? 'dropdown' : '' }}">
                        <a href="{{ $item->url ?? '#' }}"
                           class="navigation__link {{ $isActive ? 'navigation__link--active' : '' }} {{ $hasChildren ? 'dropdown-toggle' : '' }}"
                           @if($item->target_blank) target="_blank" rel="noopener noreferrer" @endif>
                            {{ $item->title }}
                        </a>

                        @if($hasChildren)
                            <ul class="dropdown-menu">
                                @foreach($item->children as $child)
                                    <li>
                                        <a href="{{ $child->url }}"
                                           class="dropdown-item"
                                           @if($child->target_blank) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            <!-- Блок, который отображается в мобильной версии меню -->
            <div class="header__menu-mobile-meta">
                <div class="header__socials">
                    @foreach($socialLinks as $social)
                        <a href="{{ $social->url }}"
                           class="header__social-link"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    @endforeach
                </div>

                <div class="header__lang">
                    <button class="header__lang-toggle" aria-label="Language">
                        <i class="fas fa-globe"></i> ქართული
                    </button>
                    <ul class="header__lang-dropdown">
                        <li><a href="#" class="header__lang-item active">ქართული</a></li>
                        <li><a href="#" class="header__lang-item">English</a></li>
                        <li><a href="#" class="header__lang-item">Deutsch</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- მარჯვენა ნაწილი (სოც.ქსელები, ენა, ღილაკი დესკტოპებისთვის) -->
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
                    <button class="header__lang-toggle" aria-label="Language"><i class="fas fa-globe"></i></button>
                    <ul class="header__lang-dropdown">
                        <li><a href="#" class="header__lang-item active">ქართული</a></li>
                        <li><a href="#" class="header__lang-item">English</a></li>
                        <li><a href="#" class="header__lang-item">Deutsch</a></li>
                    </ul>
                </div>
            </div>
            <div class="header__action">
                <a href="#" class="btn btn--outline">შესვლა</a>
            </div>
        </div>
        <!-- ბურგერ-მენიუს ღილაკი -->
        <button class="header__burger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
