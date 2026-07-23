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
                <li><a href="index.html" class="navigation__link navigation__link--active">მთავარი</a></li>
                <li class="dropdown">
                    <a href="#" class="navigation__link dropdown-toggle">ჩვენს შესახებ</a>
                    <ul class="dropdown-menu">
                        <li><a href="about.html" class="dropdown-item">კონგრესი</a></li>
                        <li><a href="charter.html" class="dropdown-item">წესდება</a></li>
                        <li><a href="protocols.html" class="dropdown-item">ოქმები</a></li>
                        <li><a href="projects.html" class="dropdown-item">პროექტები</a></li>
                    </ul>
                </li>
                <li><a href="business-hub.html" class="navigation__link">ბიზნეს-ჰაბი</a></li>
                <li><a href="contact" class="navigation__link">კონტაქტი</a></li>
            </ul>
            <!-- ბლოკი, რომელიც გამოსახული იქნება მხოლოდ მენიუს მობილურ ვერსიაში -->
            <div class="header__menu-mobile-meta">
                <div class="header__socials">
                    <a href="https://facebook.com" class="header__social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://youtube.com" class="header__social-link" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://twitter.com" class="header__social-link" target="_blank"><i class="fab fa-twitter"></i></a>
                </div>
                <div class="header__lang">
                    <button class="header__lang-toggle" aria-label="Language"><i class="fas fa-globe"></i> ქართული</button>
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
                    <a href="https://facebook.com" class="header__social-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://youtube.com" class="header__social-link" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://twitter.com" class="header__social-link" target="_blank"><i class="fab fa-twitter"></i></a>
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
