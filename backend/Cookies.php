<?php

class Cookies
{
    public function encriptar($data, $key)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);
        return base64_encode($encrypted . "::" . $iv);
    }

    public function desencriptar($data, $key)
    {
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
    }
}

if (isset($_REQUEST['guardarCookies'])) { //Se guardan las cookies y se redirecciona a "index.php", quien reconocerá que hay cookies, las leerá
    session_start();                      //y por ende, NO volverá a preguntar al usuario si quiere guardar cookies. 
    $cookies = new Cookies();
    $encript_email = $cookies->encriptar($_SESSION['email'], 'k123');
    $encript_pass = $cookies->encriptar($_SESSION['password'], 'k123');
    setcookie("Email", $encript_email, time() + (86400 * 30), "/");
    setcookie("Password", $encript_pass, time() + (86400 * 30), "/");
    header("Location: ../index.php");
}

if (isset($_REQUEST['cerrarSesion'])) { //Se borran todas las cookies y datos guardados en session, y redirecciona al inicio de la app: el forumulario log in.
    if (count($_COOKIE) > 0) {
        $past = time() - 3600;
        foreach ($_COOKIE as $key => $value) {
            setcookie($key, $value, $past, '/');
        }
    }
    session_destroy();
    header("Location: ../index.php");
}
