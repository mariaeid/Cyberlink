<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Login of users

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    $pdo = new PDO('sqlite:../database/database.db');
    $statement = $pdo -> prepare("SELECT * FROM users where email = :email");

    $statement -> bindParam(':email', $email, PDO::PARAM_STR);
    $statement -> execute();
    $userData = $statement -> fetch(PDO::FETCH_ASSOC);

    if (empty($userData)) {
        redirect('/login.php');
    }
    else {
        if (password_verify($password, $userData['password'])) {
            $_SESSION['user'] = ["id" => $userData['id'], "name" => $userData['name'], "email" => $userData['email']];

            redirect('/index.php');
        }
        else {
            redirect('/login.php');
        }
    }
}
