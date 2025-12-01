document.addEventListener('DOMContentLoaded', function() {
    const questionCards = document.querySelectorAll('.question-card');
    const submitBtn = document.querySelector('.btn-submit');
    let answeredQuestions = new Set();
    const totalQuestions = questionCards.length;

    questionCards.forEach(card => {
        const options = card.querySelectorAll('.option-item');
        const questionId = card.dataset.questionId;
        let hasAnswered = false;

        options.forEach(option => {
            option.addEventListener('click', function() {
                // Prevent multiple validations for the same question
                if (hasAnswered) {
                    return;
                }

                const selectedAnswer = this.querySelector('input[type="radio"]').value;

                // Validate answer via AJAX
                fetch(`/quiz/question/${questionId}/validate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ answer: selectedAnswer })
                })
                .then(response => response.json())
                .then(data => {
                    hasAnswered = true;

                    if (data.correct) {
                        showCheckmarkPopup(card);
                    } else {
                        showCrossPopup(card);
                        addOrangeBackground(card);
                    }

                    answeredQuestions.add(questionId);
                    checkAllAnswered();
                })
                .catch(error => {
                    console.error('Error validating answer:', error);
                });
            });
        });
    });

    function showCheckmarkPopup(card) {
        const popup = createPopup('checkmark');
        card.appendChild(popup);
        animatePopup(popup);
    }

    function showCrossPopup(card) {
        const popup = createPopup('cross');
        card.appendChild(popup);
        animatePopup(popup);
    }

    function addOrangeBackground(card) {
        card.classList.add('wrong-answer');
    }

    function createPopup(type) {
        const popup = document.createElement('div');
        popup.className = `feedback-popup ${type}-popup`;

        if (type === 'checkmark') {
            popup.innerHTML = '<img src="/images/icon/check.png" alt="Correct">';
        } else {
            popup.innerHTML = '<div class="cross-icon">✕</div>';
        }

        return popup;
    }

    function animatePopup(popup) {
        setTimeout(() => popup.classList.add('show'), 10);
        setTimeout(() => {
            popup.classList.remove('show');
            setTimeout(() => popup.remove(), 300);
        }, 2000);
    }

    function checkAllAnswered() {
        if (answeredQuestions.size === totalQuestions && submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.add('enabled');
        }
    }
});
