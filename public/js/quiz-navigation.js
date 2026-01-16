document.addEventListener('DOMContentLoaded', function () {
    const questionSlides = document.querySelectorAll('.question-slide');
    const quizTitle = document.getElementById('quiz-title');
    const btnNextQuestion = document.getElementById('btn-next-question');
    const quizSubmitForm = document.getElementById('quiz-submit-form');
    const quizAnswersInput = document.getElementById('quiz-answers');

    let currentQuestionIndex = 0;
    const totalQuestions = questionSlides.length;
    const userAnswers = {}; // Store all answers { questionId: selectedAnswer }

    if (totalQuestions === 0) {
        return; // No questions, exit
    }

    // Initialize first question
    showQuestion(currentQuestionIndex);

    // Handle option card clicks
    questionSlides.forEach((slide, slideIndex) => {
        const options = slide.querySelectorAll('.option-card');
        const questionId = slide.dataset.questionId;

        options.forEach(option => {
            option.addEventListener('click', function () {
                // Prevent clicking if already answered
                if (option.closest('.question-slide').querySelector('.option-card.selected')) {
                    return;
                }

                const selectedAnswer = option.dataset.answer;
                const isCorrect = option.dataset.correct === 'true';

                // Store the answer
                userAnswers[questionId] = selectedAnswer;

                // Mark all options as disabled
                options.forEach(opt => opt.classList.add('disabled', 'selected'));

                // Show Lottie popup animation
                showLottiePopup(isCorrect);

                // Show feedback
                if (isCorrect) {
                    option.classList.add('correct');
                    // Keep blue background for correct answer
                } else {
                    option.classList.add('wrong');
                    // Change background to orange (full page)
                    document.querySelector('.parallax-wrapper').classList.add('wrong-answer-bg');
                    document.body.classList.add('wrong-answer-bg');

                    // Also highlight the correct answer
                    options.forEach(opt => {
                        if (opt.dataset.correct === 'true') {
                            opt.classList.add('correct');
                        }
                    });
                }

                // Show next button after animation
                setTimeout(() => {
                    btnNextQuestion.style.display = 'flex';
                }, 5000);
            });
        });
    });

    // Popup function using GIF images
    function showLottiePopup(isCorrect) {
        const popup = document.getElementById('lottie-popup');
        const gifImg = document.getElementById('popup-gif');

        if (!popup || !gifImg) return;

        // Set the correct GIF URL
        const gifPath = isCorrect ? '/video/success.gif' : '/video/wrong.gif';
        gifImg.src = gifPath;

        // Show popup
        popup.style.display = 'flex';

        // Hide popup after animation
        setTimeout(() => {
            popup.style.display = 'none';
        }, 5000);
    }

    // Handle next button click
    if (btnNextQuestion) {
        btnNextQuestion.addEventListener('click', function () {
            // Reset background if it was changed
            document.querySelector('.parallax-wrapper').classList.remove('wrong-answer-bg');
            document.body.classList.remove('wrong-answer-bg');

            if (currentQuestionIndex < totalQuestions - 1) {
                // Move to next question
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
                btnNextQuestion.style.display = 'none';
            } else {
                // Last question - submit the quiz
                submitQuiz();
            }
        });
    }

    function showQuestion(index) {
        // Hide all questions
        questionSlides.forEach(slide => {
            slide.style.display = 'none';
        });

        // Show current question
        if (questionSlides[index]) {
            questionSlides[index].style.display = 'block';

            // Update title
            if (quizTitle) {
                quizTitle.textContent = `QUIZ ${index + 1}`;
            }
        }
    }

    function submitQuiz() {
        // Convert answers object to JSON
        quizAnswersInput.value = JSON.stringify(userAnswers);

        // Submit the form
        quizSubmitForm.submit();
    }
});
