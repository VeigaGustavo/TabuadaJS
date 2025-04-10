<?php
// Ativa a exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Carrega configurações
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/process/game_logic.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include __DIR__ . '/includes/head.php'; ?>
</head>
<body>
    <div class="game-container">
        <?php if (!isset($_SESSION['game_started']) || !$_SESSION['game_started']): ?>
            <?php include __DIR__ . '/views/start_form.php'; ?>
        <?php else: ?>
            <?php include __DIR__ . (($is_game_over ?? false) ? '/views/scoreboard.php' : '/views/game.php'); ?>
        <?php endif; ?>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>