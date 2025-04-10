<?php
session_start();
?>


<!-- Arquivo: views/scoreboard.php -->
<div class="scoreboard-container">
    <img src="assets/img/ifto.jpg" alt="Logo IFTO" class="ifto-logo">
    
    <div class="game-over">⏱️ Tempo esgotado! Fim do jogo!</div>

    <div class="scoreboard">
        <h3>🏆 Placar</h3>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>✅ Acertos</th>
                    <th>❌ Erros</th>
                    <th>⏱️ Tempo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['scoreboard'] as $score): ?>
                    <tr>
                        <td><?= htmlspecialchars($score['name']) ?></td>
                        <td class="correct"><?= $score['correct'] ?></td>
                        <td class="wrong"><?= $score['wrong'] ?></td>
                        <td><?= $score['time'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <form method="post">
        <button type="submit" name="restart" id="jogarNovamente">🔁 Jogar Novamente</button>
    </form>

    <div class="credits">
        Desenvolvido por <a href="https://github.com/gustavoantunes7" target="_blank">Gustavo Antunes</a>
    </div>
</div>