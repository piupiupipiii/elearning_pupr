document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.slider-track');
    const cards = Array.from(document.querySelectorAll('.slider-card'));
    const leftTitle = document.getElementById('left-title');
    const leftSubtitle = document.getElementById('left-subtitle');
    const leftDesc = document.getElementById('left-desc');
    const btnMulai = document.getElementById('btn-mulai');
    const leftBtn = document.querySelector('.nav-left');
    const rightBtn = document.querySelector('.nav-right');

    if (!track || cards.length === 0) {
        console.warn('Slider elements not found');
        return;
    }

    let currentIndex = window.sliderInitialIndex || 0;

    function updateSlider() {
        // Remove all size classes
        cards.forEach(card => {
            card.classList.remove('size-large', 'size-medium', 'size-medium2', 'size-small');
        });

        // Add size classes based on position relative to currentIndex
        cards.forEach((card, index) => {
            if (index === currentIndex) {
                card.classList.add('size-large');
            } else if (index === currentIndex - 1 || index === currentIndex + 1) {
                card.classList.add('size-medium');
            } else if (index === currentIndex - 2 || index === currentIndex + 2) {
                card.classList.add('size-medium2');
            } else {
                card.classList.add('size-small');
            }
        });

        // Update left panel content
        const currentCard = cards[currentIndex];
        if (currentCard && leftTitle && leftSubtitle && leftDesc) {
            leftTitle.textContent = currentCard.dataset.title || '';
            leftSubtitle.textContent = currentCard.dataset.subtitle || '';
            leftDesc.textContent = currentCard.dataset.desc || '';

            // Update Mulai button
            if (btnMulai) {
                const isLocked = currentCard.dataset.locked === 'true';
                const href = currentCard.getAttribute('href');

                if (isLocked || !href || href === 'javascript:void(0)') {
                    btnMulai.style.display = 'none';
                } else {
                    btnMulai.style.display = 'inline-block';
                    btnMulai.href = href;
                }
            }
        }

        // Geser track agar card aktif selalu di tengah viewport
        // Geser track agar card aktif selalu di kiri viewport (previous hidden)
        const gap = 32; // gap CSS
        let offset = 0;

        // Hitung lebar total kartu sebelum currentIndex
        for (let i = 0; i < currentIndex; i++) {
            let width = 220; // size-small default (was 200)

            if (i === currentIndex - 1) {
                width = 260; // size-medium (was 240)
            } else if (i === currentIndex - 2) {
                width = 240; // size-medium2 (was 220)
            }
            // Note: size-large (now 300) hanya untuk currentIndex, jadi tidak masuk hitungan offset previous

            offset += width + gap;
        }

        track.style.transform = `translateX(-${offset}px)`;

        // Update button states
        updateNavigationButtons();
    }

    function updateNavigationButtons() {
        if (leftBtn) {
            leftBtn.disabled = currentIndex === 0;
            leftBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
            leftBtn.style.cursor = currentIndex === 0 ? 'not-allowed' : 'pointer';
        }

        if (rightBtn) {
            rightBtn.disabled = currentIndex === cards.length - 1;
            rightBtn.style.opacity = currentIndex === cards.length - 1 ? '0.5' : '1';
            rightBtn.style.cursor = currentIndex === cards.length - 1 ? 'not-allowed' : 'pointer';
        }
    }

    // Navigation buttons
    if (rightBtn) {
        rightBtn.addEventListener('click', () => {
            if (currentIndex < cards.length - 1) {
                currentIndex++;
                updateSlider();
            }
        });
    }

    if (leftBtn) {
        leftBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight' && currentIndex < cards.length - 1) {
            currentIndex++;
            updateSlider();
        }
        if (e.key === 'ArrowLeft' && currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    if (track) {
        track.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        track.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0 && currentIndex < cards.length - 1) {
                // Swipe left - go to next
                currentIndex++;
                updateSlider();
            } else if (diff < 0 && currentIndex > 0) {
                // Swipe right - go to previous
                currentIndex--;
                updateSlider();
            }
        }
    }

    // Click on card to make it active
    cards.forEach((card, index) => {
        card.addEventListener('click', (e) => {
            const isLocked = card.dataset.locked === 'true';

            // If clicking on a different card (not the active one)
            if (index !== currentIndex) {
                e.preventDefault();
                currentIndex = index;
                updateSlider();
            }
            // If it's locked and already active, the onclick handler in the HTML will handle it
        });
    });

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            updateSlider();
        }, 250);
    });

    // Initialize
    updateSlider();
});
