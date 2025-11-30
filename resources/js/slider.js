// public/js/slider.js
document.addEventListener('DOMContentLoaded', function () {
  const track        = document.querySelector('.slider-track');
  const cards        = Array.from(document.querySelectorAll('.slider-card'));
  const leftTitle    = document.getElementById('left-title');
  const leftSubtitle = document.getElementById('left-subtitle');
  const leftDesc     = document.getElementById('left-desc');
  const leftBtn      = document.querySelector('.nav-left');
  const rightBtn     = document.querySelector('.nav-right');

  if (!track || cards.length === 0) return;

  let index = 0;
  let cardWidth = getCardWidth();

  function getCardWidth() {
    const style = getComputedStyle(track);
    const gap = parseFloat(style.columnGap || style.gap || 36);
    const baseWidth = cards[0].getBoundingClientRect().width;
    return baseWidth + gap;
  }

  function clamp(v, min, max) {
    return Math.max(min, Math.min(max, v));
  }

  function updateActiveClasses() {
    cards.forEach((card, i) => {
      if (i === index) {
        card.classList.add('size-large');
        card.classList.remove('size-small');
      } else {
        card.classList.add('size-small');
        card.classList.remove('size-large');
      }
    });
  }

  function updateSlider() {
    const maxIndex = Math.max(0, cards.length - 1);
    index = clamp(index, 0, maxIndex);

    const translateX = -index * cardWidth;
    track.style.transform = `translateX(${translateX}px)`;

    const active = cards[index];
    if (active) {
      if (leftTitle)    leftTitle.textContent    = active.dataset.title || '';
      if (leftSubtitle) leftSubtitle.textContent = active.dataset.subtitle || '';
      if (leftDesc)     leftDesc.textContent     = active.dataset.desc || '';
    }

    updateActiveClasses();
  }

  // inisialisasi
  updateSlider();

  // tombol panah
  if (rightBtn) {
    rightBtn.addEventListener('click', () => {
      index++;
      updateSlider();
    });
  }

  if (leftBtn) {
    leftBtn.addEventListener('click', () => {
      index--;
      updateSlider();
    });
  }

  // keyboard (opsional)
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') { index++; updateSlider(); }
    if (e.key === 'ArrowLeft')  { index--; updateSlider(); }
  });

  // responsif: hitung ulang lebar kartu
  window.addEventListener('resize', () => {
    cardWidth = getCardWidth();
    updateSlider();
  });
});
