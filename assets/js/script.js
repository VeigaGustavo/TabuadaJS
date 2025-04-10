function startGame(startTime) {
    const timerElement = document.getElementById('timer');  // Pega o elemento onde o tempo será exibido

    function updateTimer() {
        const currentTime = Math.floor(Date.now() / 1000);  // Pega o tempo atual em segundos
        const elapsed = currentTime - startTime;  // Calcula o tempo decorrido
        const minutes = String(Math.floor(elapsed / 60)).padStart(2, '0');
        const seconds = String(elapsed % 60).padStart(2, '0');
        timerElement.textContent = `${minutes}:${seconds}`;  // Exibe o tempo

        if (elapsed >= 120) {
            document.getElementById('game-form').submit();  // Envia o formulário após 2 minutos
        } else {
            setTimeout(updateTimer, 1000);  // Atualiza o tempo a cada segundo
        }
    }

    updateTimer();  // Inicia a contagem assim que o jogo começar
}
