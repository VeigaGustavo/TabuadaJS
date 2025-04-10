<?php
// includes/functions.php

function generateQuestion() {
    static $last = null;
    do {
        $a = rand(MIN_NUMBER, MAX_NUMBER);
        $b = rand(MIN_NUMBER, MAX_NUMBER);
        $is_repeat = $last && (($a === $last['a'] && $b === $last['b']) || ($a === $last['b'] && $b === $last['a']));
    } while ($is_repeat);

    $last = ['a' => $a, 'b' => $b];
    return [
        'a' => $a,
        'b' => $b,
        'correct_answer' => $a * $b
    ];
}

function saveScore($name, $correct, $wrong, $time) {
    // Garante que $name não seja null
    $name = $name ?? 'Anônimo';
    $_SESSION['scoreboard'][] = [
        'name' => htmlspecialchars($name),
        'correct' => $correct,
        'wrong' => $wrong,
        'time' => $time
    ];
    
    // Ordena por acertos (decrescente)
    usort($_SESSION['scoreboard'], fn($a, $b) => $b['correct'] <=> $a['correct']);
}