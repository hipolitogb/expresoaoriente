<?php
/**
 * Contact form handler
 * Validates input, checks captcha, sends email via mail()
 */

require_once __DIR__ . '/../components/captcha.php';

$redirect_base = BASE_PATH . '/' . $lang . '/' . ($lang === 'es' ? 'contacto' : 'contact');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $redirect_base, true, 302);
    exit;
}

// Honeypot check
if (!empty($_POST['website'])) {
    header('Location: ' . $redirect_base . '?sent=1', true, 302);
    exit;
}

// Validate required fields
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$captcha_answer = trim($_POST['captcha_answer'] ?? '');
$captcha_hash = $_POST['captcha_hash'] ?? '';

if (empty($name) || empty($email) || empty($message)) {
    header('Location: ' . $redirect_base . '?error=fields', true, 302);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ' . $redirect_base . '?error=email', true, 302);
    exit;
}

// Validate captcha
if (!captcha_validate($captcha_answer, $captcha_hash)) {
    header('Location: ' . $redirect_base . '?error=captcha', true, 302);
    exit;
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$message_body = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Build email
$to = SITE_EMAIL;
$subject = 'Contacto desde ' . SITE_NAME . ' - ' . $name;
$body = "Nombre: $name\n";
$body .= "Email: $email\n\n";
$body .= "Mensaje:\n$message_body\n";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$sent = @mail($to, $subject, $body, $headers);

if ($sent) {
    header('Location: ' . $redirect_base . '?sent=1', true, 302);
} else {
    header('Location: ' . $redirect_base . '?error=send', true, 302);
}
exit;
