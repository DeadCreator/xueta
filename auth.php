ф<?php
session_start();

if (isset($_POST['login'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        include 'User.php';

        $user = new User();
        $user -> login($_POST['email'], $_POST['password']);
        if (!isset($_SESSION['error'])) {
            echo 'nice';
            $_SESSION['user'] = [
                'name' => $user -> getName(),
                'surname' => $user -> getSurname(),
                'email' => $user -> getEmail(),
                'date' => $user -> getDate(),
                'passport_serie' => $user -> getPassportSerie(),
                'passport_num' => $user -> getPassportNum(),
                'password_hash' => $user -> getPasswordHash(),
                'public_key' => $user -> getPublicKey(),
                'private_key' => $user ->  getPrivateKey()
            ];
        }
    }
}

if (isset($_POST['register'])) {
    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['date']) && !empty($_POST['passport_serie']) && !empty($_POST['passport_num'])  && !empty($_POST['password'])) {
        include 'User.php';

        $user = new User();
        $user -> register($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['date'], $_POST['passport_serie'], $_POST['passport_num'], $_POST['password']);

        $_SESSION['user'] = [
            'name' => $user -> getName(),
            'surname' => $user -> getSurname(),
            'email' => $user -> getEmail(),
            'data' => $user -> getDate(),
            'passport_serie' => $user -> getPassportSerie(),
            'passport_num' => $user -> getPassportNum(),
            'password_hash' => $user -> getPasswordHash(),
            'public_key' => $user -> getPublicKey(),
            'private_key' => $user ->  getPrivateKey()
        ];
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
}

header('Location: index.php');