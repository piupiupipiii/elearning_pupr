// public/js/parallax.js
document.addEventListener('DOMContentLoaded', function () {
  const track = document.querySelector('.slider-track');
  const cards = Array.from(document.querySelectorAll('.slider-card'));
  const leftTitle = document.getElementById('left-title');
  const leftSubtitle = document.getElementById('left-subtitle');
  const leftDesc = document.getElementById('left-desc');
  const leftBtn = document.querySelector('.nav-left');
  const rightBtn = document.querySelector('.nav-right');
  const ornament = document.querySelectorAll('.parallax');
  if (!track || cards.length === 0) return;

  let index = 0;
  const cardWidth = cards[0].getBoundingClientRect().width + parseFloat(getComputedStyle(track).gap || 28);

  function clamp(v, a, b) { return Math.max(a, Math.min(b, v)); }

  function updateSlider() {
    const maxIndex = Math.max(0, cards.length - 1);
    index = clamp(index, 0, maxIndex);
    const translateX = -index * (cardWidth);
    track.style.transform = `translateX(${translateX}px)`;

    // update left content from data- attributes (fallback safe)
    const active = cards[index];
    if (active) {
      leftTitle && (leftTitle.textContent = active.dataset.title || leftTitle.textContent);
      leftSubtitle && (leftSubtitle.textContent = active.dataset.subtitle || leftSubtitle.textContent);
      leftDesc && (leftDesc.textContent = active.dataset.desc || leftDesc.textContent);
    }
  }

  // initial
  updateSlider();

  // navigation
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

  // allow keyboard navigation (optional)
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') { index++; updateSlider(); }
    if (e.key === 'ArrowLeft') { index--; updateSlider(); }
  });

  // Parallax ornament subtle movement on mouse
  document.addEventListener('mousemove', (ev) => {
    ornament.forEach((el) => {
      const speed = parseFloat(el.dataset.speed) || 0.08;
      const tx = (ev.clientX - window.innerWidth / 2) * speed * -0.02;
      const ty = (ev.clientY - window.innerHeight / 2) * speed * -0.02;
      el.style.transform = `translate(${tx}px, ${ty}px)`;
    });
  });

  // make slider responsive on resize (recompute width)
  window.addEventListener('resize', () => {
    // recalc cardWidth
    // note: we keep using first card width; updateSlider will apply new transform
    updateSlider();
  });
});
