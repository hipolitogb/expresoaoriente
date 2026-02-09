<?php
/**
 * Simple math captcha - no external dependencies
 * Usage:
 *   Generate: captcha_generate() → returns ['question' => '3 + 7', 'answer_hash' => '...']
 *   Validate: captcha_validate($user_answer, $answer_hash) → bool
 */

function captcha_generate() {
    $a = rand(1, 9);
    $b = rand(1, 9);
    $answer = $a + $b;
    $hash = hash('sha256', $answer . '_expreso_salt_' . date('Y-m-d'));

    return [
        'question'    => "$a + $b = ?",
        'answer_hash' => $hash
    ];
}

function captcha_validate($user_answer, $answer_hash) {
    $user_answer = intval(trim($user_answer));
    $expected_hash = hash('sha256', $user_answer . '_expreso_salt_' . date('Y-m-d'));
    return hash_equals($expected_hash, $answer_hash);
}
