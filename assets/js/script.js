// Constante para a duração do jogo em segundos
const GAME_DURATION = 120; // 2 minutos

function startGame(startTime) {
    const timerElement = document.getElementById('timer');
    
    if (!timerElement) {
        console.error('Elemento timer não encontrado!');
        return;
    }

    let isGameRunning = true;

    function formatTime(timeInSeconds) {
        const minutes = String(Math.floor(timeInSeconds / 60)).padStart(2, '0');
        const seconds = String(timeInSeconds % 60).padStart(2, '0');
        return `${minutes}:${seconds}`;
    }

    function updateTimer() {
        if (!isGameRunning) return;

        const currentTime = Math.floor(Date.now() / 1000);
        const elapsed = currentTime - startTime;
        const timeLeft = Math.max(0, GAME_DURATION - elapsed);
        
        timerElement.textContent = formatTime(timeLeft);

        if (timeLeft <= 0) {
            isGameRunning = false;
            const gameForm = document.getElementById('game-form');
            if (gameForm) {
                gameForm.submit();
            } else {
                console.error('Formulário do jogo não encontrado!');
            }
            return;
        }

        // Agenda a próxima atualização
        setTimeout(updateTimer, 1000);
    }

    // Inicia a contagem regressiva imediatamente
    updateTimer();
}

// Expõe a função startGame globalmente
window.startGame = startGame;
