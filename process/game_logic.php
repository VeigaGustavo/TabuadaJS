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
            unset($_SESSION['last_wrong']); // Limpa mensagem anterior
        } else {
            $_SESSION['wrong']++;
            // Salva cálculo anterior para exibir mensagem de erro
            $_SESSION['last_wrong'] = [
                'a' => $_SESSION['current_question']['a'],
                'b' => $_SESSION['current_question']['b'],
                'resposta' => $_SESSION['current_question']['correct_answer']
            ];
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

// Processa o botão Jogar Novamente
if (isset($_POST['restart'])) {
    // Limpa as variáveis de sessão do jogo
    $_SESSION['game_started'] = false;
    $_SESSION['player_name'] = '';
    $_SESSION['correct'] = 0;
    $_SESSION['wrong'] = 0;
    $_SESSION['game_ended'] = false;
    unset($_SESSION['current_question']);
    unset($_SESSION['start_time']);
    // Redireciona para a página inicial
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}