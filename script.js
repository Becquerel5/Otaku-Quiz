function calculateResults() {
    const checkboxes = document.querySelectorAll('.participant-checkbox');
    const scores = {};

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const participantId = checkbox.value;
            if (!scores[participantId]) {
                scores[participantId] = 0;
            }
            scores[participantId]++;
        }
    });

    const sortedScores = Object.keys(scores).sort((a, b) => scores[b] - scores[a]);

    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '<h2>Results</h2>';

    if (sortedScores.length > 0) {
        resultsDiv.innerHTML += '<ol>';
        
        sortedScores.forEach(participantId => {
            const participantName = document.querySelector(`input[value="${participantId}"]`).closest('li').querySelector('strong').innerText;
            resultsDiv.innerHTML += `<li>${participantName} - ${scores[participantId]} points</li>`;
        });

        resultsDiv.innerHTML += '</ol>';
    } else {
        resultsDiv.innerHTML += '<p>No checkboxes selected.</p>';
    }
}