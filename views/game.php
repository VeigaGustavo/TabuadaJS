<!-- Arquivo: views/game.php -->
<div class="game">
    <img src="assets/img/ifto.jpg" alt="Logo IFTO" class="ifto-logo">
    
    <div class="stats">
        <span>Jogador: <?= htmlspecialchars($_SESSION['player_name']) ?></span>
        <span class="correct">✅ Acertos: <?= $_SESSION['correct'] ?></span>
        <span class="wrong">❌ Erros: <?= $_SESSION['wrong'] ?></span>
    </div>

    <div id="timer" class="timer">02:00</div>

    <div class="question">
        <?= $_SESSION['current_question']['a'] ?> × <?= $_SESSION['current_question']['b'] ?> = ?
    </div>

    <form method="post" id="game-form">
        <input type="number" name="answer" class="answer-input" required autofocus>
        <button type="submit">Responder</button>
    </form>

    <?php if (isset($_SESSION['last_wrong'])): ?>
        <div class="wrong-message" style="color: #dc3545; margin-top: 10px; font-size: 1.1rem;">
            Cálculo anterior: <?= $_SESSION['last_wrong']['a'] ?> × <?= $_SESSION['last_wrong']['b'] ?> = <?= $_SESSION['last_wrong']['resposta'] ?>
        </div>
    <?php endif; ?>

    <div class="credits">
        Desenvolvido por <a href="https://github.com/gustavoantunes7" target="_blank">Gustavo Antunes</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startTime = <?= $_SESSION['start_time'] ?? 'Math.floor(Date.now() / 1000)' ?>;
    window.startGame(startTime);
});
</script>
