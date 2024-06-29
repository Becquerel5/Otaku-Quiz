document.addEventListener('DOMContentLoaded', () => {
    let timerElement = document.getElementById('timer');
    let questionTextElement = document.getElementById('question-text');
    let choicesElement = document.getElementById('choices');
    let currentQuestionIndex = 0;
    let timeLeft = 10;
    let countdown;
    let showingAnswer = false;

    function loadQuestion(index) {
        if (index >= questions.length) {
            questionTextElement.textContent = "Quiz terminé!";
            choicesElement.innerHTML = "";
            timerElement.textContent = "";
            clearInterval(countdown);
            return;
        }

        const question = questions[index];
        questionTextElement.textContent = question.question_text;
        //questionTextElement.textContent = question.correct_answer;
        choicesElement.innerHTML = "";

        fetch(`get_choices.php?question_id=${question.id}`)
            .then(response => response.json())
            .then(choices => {
                choices.forEach(choice => {
                    let button = document.createElement('button');
                    button.textContent = choice.choice_text;
                    button.classList.add('choice');
                    button.dataset.correct = choice.choice_text === question.correct_answer;
                    button.addEventListener('click', () => {
                        // Placeholder for any click action needed
                    });
                    choicesElement.appendChild(button);
                });
            });

        timeLeft = 10;
        timerElement.textContent = timeLeft;
        showingAnswer = false;
    }

    /* function showCorrectAnswer() {
        const correctAnswer = questions[currentQuestionIndex].correct_answer;
        Array.from(choicesElement.children).forEach(button => {
            if (button.textContent === correctAnswer) {
                button.style.backgroundColor = 'green';
            } else {
                button.style.backgroundColor = 'red';
            }
        });

        console.log(correctAnswer);
        showingAnswer = true;

    } */


    /* function showCorrectAnswer() {
        const correctAnswer = questions[currentQuestionIndex].correct_answer;
        console.log('Correct Answer:', correctAnswer);  // Log the correct answer
        
        // Update the <p> element with the correct answer
        const correctAnswerDisplay = document.getElementById('correctAnswerDisplay');
        correctAnswerDisplay.textContent = `Reponse = ${correctAnswer}`;
        
        Array.from(choicesElement.children).forEach(button => {
            if (button.textContent === correctAnswer) {
                button.style.backgroundColor = 'green';
            } else {
                button.style.backgroundColor = 'red';
            }
        });
        showingAnswer = true;
    } */


    function showCorrectAnswer() {
        const question = questions[currentQuestionIndex].question_text;
        const correctAnswer = questions[currentQuestionIndex].correct_answer;
        console.log('Correct Answer:', correctAnswer);  // Log the correct answer

        // Delay the display of the correct answer by 10 seconds
        setTimeout(() => {
            // Update the <p> element with the correct answer
            const correctAnswerDisplay = document.getElementById('correctAnswerDisplay');
            correctAnswerDisplay.textContent = `Reponse de la question "${question}" = ${correctAnswer}`;

            Array.from(choicesElement.children).forEach(button => {
                if (button.textContent === correctAnswer) {
                    button.style.backgroundColor = 'green';
                } else {
                    button.style.backgroundColor = 'red';
                }
            });
            showingAnswer = true;
        }, 1000);  // 10000 milliseconds = 10 seconds
    }


    function nextQuestion() {
        currentQuestionIndex++;
        loadQuestion(currentQuestionIndex);
    }

    function startCountdown() {
        countdown = setInterval(() => {
            if (timeLeft > 0 && !showingAnswer) {
                timeLeft--;
                timerElement.textContent = timeLeft;
            } else if (timeLeft === 0 && !showingAnswer) {
                showCorrectAnswer();
                timeLeft = 3; // Set time for showing the answer
            } else if (timeLeft > 0 && showingAnswer) {
                timeLeft--;
                timerElement.textContent = timeLeft;
            } else if (timeLeft === 0 && showingAnswer) {
                nextQuestion();
            }
        }, 1000);
    }

    loadQuestion(currentQuestionIndex);
    startCountdown();
});


/* function loadAnswer(index) {
    if (index >= questions.length) {
        return;
    }

    const question = questions[index];
    const correctAnswerText = question.correct_answer;

    // Clear the choices and show the correct answer
    choicesElement.innerHTML = "";
    const correctAnswerElement = document.createElement('div');
    correctAnswerElement.textContent = `Correct Answer: ${correctAnswerText}`;
    correctAnswerElement.classList.add('correct-answer');
    choicesElement.appendChild(correctAnswerElement);
} */