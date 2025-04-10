<?php
// process/game_logic.php
require_once __DIR__ . '/../includes/config.php';

// Processa início do jogo
if (isset($_POST['start_game']) && !empty($_POST['player_name'])) {
    $_SESSION['game_started'] = true;
    $_SESSION['player_name'] = htmlspecialchars($_POST['player_name'] ?? '');
    $_SESSION['correct'] = 0;
    $_SESSION['wrong'] = 0;
    $_SESSION['start_time'] = time();
    $_SESSION['game_ended'] = false;
    $_SESSION['current_question'] = generateQuestion();
    $_SESSION['scoreboard'] = []; // Reinicia o placar
}

// Só executa a lógica do jogo se o jogo tiver começado
if ($_SESSION['game_started'] ?? false) {
    $elapsed_time = time() - ($_SESSION['start_time'] ?? 0);
    $is_game_over = $elapsed_time >= GAME_DURATION;

    // Processa respostas
    if (isset($_POST['answer']) && !($_SESSION['game_ended'] ?? false)) {
        $answer = (int)($_POST['answer'] ?? 0);
        if (isset($_SESSION['current_question']['correct_answer']) && 
            $answer === $_SESSION['current_question']['correct_answer']) {
            $_SESSION['correct']++;
        } else {
            $_SESSION['wrong']++;
        }
        $_SESSION['current_question'] = generateQuestion();
    }

    // Finaliza jogo se necessário
    if ($is_game_over && !($_SESSION['game_ended'] ?? false)) {
        $_SESSION['game_ended'] = true;
        saveScore(
            $_SESSION['player_name'],
            $_SESSION['correct'],
            $_SESSION['wrong'],
            gmdate("i:s", $elapsed_time)
        );
    }
}