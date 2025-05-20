const GAME_DURATION = 60;
let gameInterval;
let startTime;
let correct = 0;
let wrong = 0;
let a, b;

function svgCorrect() {
    return `<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="10" fill="#2d8f2d"/><path d="M6 10.5L9 13.5L14 8.5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
}
function svgWrong() {
    return `<svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="10" fill="#d32f2f"/><path d="M7 7L13 13M13 7L7 13" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>`;
}

function pad(n) {
    return n < 10 ? '0' + n : n;
}

function formatTime(seconds) {
    return pad(Math.floor(seconds / 60)) + ':' + pad(seconds % 60);
}

function generateQuestion() {
    a = Math.floor(Math.random() * 10) + 1;
    b = Math.floor(Math.random() * 10) + 1;
    document.getElementById('question').innerText = `${a} × ${b} = ?`;
}

function startGame() {
    const playerName = document.getElementById('playerName').value;
    if (!playerName) return;
    localStorage.setItem('playerName', playerName);
    document.getElementById('startForm').style.display = 'none';
    document.getElementById('gamePlay').style.display = 'block';
    startTime = Date.now();
    correct = 0;
    wrong = 0;
    updateStats();
    gameInterval = setInterval(updateTimer, 1000);
    updateTimer();
    generateQuestion();
    setTimeout(() => document.getElementById('answer').focus(), 100);
}

function updateTimer() {
    const elapsed = Math.floor((Date.now() - startTime) / 1000);
    const remaining = GAME_DURATION - elapsed;
    document.getElementById('timer').innerText = formatTime(Math.max(remaining, 0));
    if (remaining <= 0) {
        clearInterval(gameInterval);
        endGame();
    }
}

function submitAnswer(e) {
    if (e) e.preventDefault();
    const answer = parseInt(document.getElementById('answer').value);
    if (answer === a * b) {
        correct++;
    } else {
        wrong++;
    }
    updateStats();
    generateQuestion();
    document.getElementById('answer').value = '';
    document.getElementById('answer').focus();
}

function updateStats() {
    document.getElementById('correctCount').innerText = correct;
    document.getElementById('wrongCount').innerText = wrong;
    document.getElementById('correctCountPlay').innerText = correct;
    document.getElementById('wrongCountPlay').innerText = wrong;
}

function endGame() {
    document.getElementById('gamePlay').style.display = 'none';
    document.getElementById('gameOver').style.display = 'block';
    document.getElementById('correctCount').innerText = correct;
    document.getElementById('wrongCount').innerText = wrong;
}

function restartGame() {
    correct = 0;
    wrong = 0;
    updateStats();
    document.getElementById('gameOver').style.display = 'none';
    document.getElementById('startForm').style.display = 'block';
    document.getElementById('playerName').focus();
}

// Adiciona SVGs aos ícones
function setIcons() {
    document.getElementById('icon-correct').innerHTML = svgCorrect();
    document.getElementById('icon-wrong').innerHTML = svgWrong();
    document.getElementById('icon-correct-play').innerHTML = svgCorrect();
    document.getElementById('icon-wrong-play').innerHTML = svgWrong();
}

setIcons();
document.getElementById('answerForm').addEventListener('submit', submitAnswer);
document.getElementById('playerName').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') startGame();
}); 