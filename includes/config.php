<?php
// includes/config.php

// Inicializa a sessão se ainda não estiver ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurações básicas
define('GAME_DURATION', 120); // 2 minutos em segundos
define('MIN_NUMBER', 2);
define('MAX_NUMBER', 9);

// Inicializa todas as variáveis de sessão necessárias
if (!isset($_SESSION['initialized'])) {
    $_SESSION['scoreboard'] = [];
    $_SESSION['game_started'] = false;
    $_SESSION['player_name'] = '';
    $_SESSION['correct'] = 0;
    $_SESSION['wrong'] = 0;
    $_SESSION['start_time'] = 0;
    $_SESSION['game_ended'] = false;
    $_SESSION['current_question'] = null;
    $_SESSION['initialized'] = true; // Marca como inicializado
}