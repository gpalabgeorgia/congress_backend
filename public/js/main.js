document.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector('.header__burger');
    const nav = document.querySelector('.header__nav');

    burger.addEventListener('click', () => {
        burger.classList.toggle('active');
        nav.classList.toggle('active');
        // ვკრძალავთ გვერდის სქროლს გახსნილი მენიუს დროს
        document.body.classList.toggle('no-scroll');
    });

    // ვხურავთ მენიუს ნებისმიერ ბმულზე დაწკაპებისას
    const navLinks = document.querySelectorAll('.navigation__link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            burger.classList.remove('active');
            nav.classList.remove('active');
            document.body.classList.remove('no-scroll');
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const video = document.getElementById("promo-video");
    const playBtn = document.getElementById("video-control-btn");
    const mediaContainer = document.querySelector(".video-section__media");

    const iconPlay = playBtn.querySelector(".icon-play");
    const iconPause = playBtn.querySelector(".icon-pause");
    const iconReplay = playBtn.querySelector(".icon-replay");

    // Play / Pause / Replay მდგომარეობის გადართვის ფუნქცია
    function togglePlay() {
        // თუ ვიდეო დასრულდა — ვუშვებთ თავიდან
        if (video.ended) {
            video.currentTime = 0;
            video.play();
            showPauseIcon();
        }
        // თუ ვიდეო პაუზაზეა — ვუშვებთ
        else if (video.paused) {
            video.play();
            showPauseIcon();
        }
        // თუ ვიდეო მიდის — ვაყენებთ პაუზაზე
        else {
            video.pause();
            showPlayIcon();
        }
    }

    function showPauseIcon() {
        mediaContainer.classList.add("is-playing");
        iconPlay.style.display = "none";
        iconReplay.style.display = "none";
        iconPause.style.display = "block";
    }

    function showPlayIcon() {
        mediaContainer.classList.remove("is-playing");
        iconPause.style.display = "none";
        iconReplay.style.display = "none";
        iconPlay.style.display = "block";
    }

    function showReplayIcon() {
        mediaContainer.classList.remove("is-playing");
        iconPlay.style.display = "none";
        iconPause.style.display = "none";
        iconReplay.style.display = "block";
    }

    // ვიდეოს დასასრულის თვალთვალი
    video.addEventListener("ended", () => {
        showReplayIcon();
    });

    // ღილაკზე და ვიდეოზე წკაპი
    playBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        togglePlay();
    });

    video.addEventListener("click", togglePlay);
});

document.addEventListener("DOMContentLoaded", () => {
    const track = document.getElementById("events-slider-track");
    const prevBtn = document.getElementById("slider-prev");
    const nextBtn = document.getElementById("slider-next");
    if (track && prevBtn && nextBtn) {
        // გადასვლის ნაბიჯის გათვლის ფუნქცია
        const getScrollStep = () => {
            const card = track.querySelector(".event-card");
            if (!card) return 300;
            return card.getBoundingClientRect().width + 30; // ბარათის სიფართე + gap
        };
        nextBtn.addEventListener("click", () => {
            const step = getScrollStep();
            // მაქსიმალურად შესაძლო მანძილი სქროლისთვის
            const maxScrollLeft = track.scrollWidth - track.clientWidth;
            // თუ მარჯვენა კიდეში ვართ (ცდომილება 5px სუბპიქსელზე)
            if (track.scrollLeft >= maxScrollLeft - 5) {
                // ვახვევთ თავში
                track.scrollTo({
                    left: 0,
                    behavior: "smooth"
                });
            } else {
                // სხვაგვარად ვაგრძელებთ გადაფურცვლას
                track.scrollBy({
                    left: step,
                    behavior: "smooth"
                });
            }
        });
        prevBtn.addEventListener("click", () => {
            const step = getScrollStep();
            // თუ სულ თავში ვართ — ვახვევთ ბოლოში
            if (track.scrollLeft <= 5) {
                track.scrollTo({
                    left: track.scrollWidth,
                    behavior: "smooth"
                });
            } else {
                track.scrollBy({
                    left: -step,
                    behavior: "smooth"
                });
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const backToTopBtn = document.getElementById("backToTopBtn");

    if (backToTopBtn) {
        // Показываем/скрываем кнопку при прокрутке
        window.addEventListener("scroll", () => {
            if (window.scrollY > 400) {
                backToTopBtn.classList.add("is-visible");
            } else {
                backToTopBtn.classList.remove("is-visible");
            }
        });

        // Плавный скролл наверх при клике
        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const minuteItems = document.querySelectorAll('.minute-item');
    const pdfFrame = document.getElementById('pdf-frame');

    minuteItems.forEach(item => {
        item.addEventListener('click', function() {
            // Убираем класс active у всех
            minuteItems.forEach(el => el.classList.remove('active'));

            // Добавляем active кликнутому элементу
            this.classList.add('active');

            // Получаем путь к PDF файлу и вставляем его в iframe
            const pdfUrl = this.getAttribute('data-pdf');
            if (pdfUrl) {
                pdfFrame.setAttribute('src', pdfUrl);
            }
        });
    });
});