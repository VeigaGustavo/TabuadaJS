<!-- Arquivo: views/game.php -->
<div class="header">
    <div><strong><?= $_SESSION['player_name'] ?></strong></div>
    <div class="timer" id="timer"><?= gmdate("i:s", $elapsed_time) ?></div>
</div>

<div class="stats">
    <div class="correct">✅ <?= $_SESSION['correct'] ?> acertos</div>
    <div class="wrong">❌ <?= $_SESSION['wrong'] ?> erros</div>
</div>

<div class="question">
    Quanto é <?= $_SESSION['current_question']['a'] ?> × <?= $_SESSION['current_question']['b'] ?>?
</div>

<form method="post" id="game-form">
    <input type="number" name="answer" placeholder="Digite sua resposta" required autofocus>
    <button type="submit">Responder</button>
</form>

<!-- Dentro da view onde o jogo é mostrado -->
<script>
    // Passa a variável PHP 'start_time' para o JavaScript
    const startTime = <?php echo $_SESSION['start_time']; ?>;

    // Chama o arquivo JS para manipular o tempo
    window.onload = function() {
        startGame(startTime);
    }
</script>
