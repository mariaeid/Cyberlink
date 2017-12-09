<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Login of users

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $pdo = new PDO('sqlite:../database/database.db');
    $statement = $pdo -> prepare("SELECT * FROM users where email = :email");

    $statement -> bindParam(':email', $email, PDO::PARAM_STR);
    $statement -> execute();
    $userData = $statement -> fetch(PDO::FETCH_ASSOC);

    //Redirecting back to login page if the email address doesn't exist
    if (empty($userData)) {
        redirect('/login.php');
    }
    //If the email address exists and the password match we store the user details in a session and redirects the user to the start page
    else {
        if (password_verify($password, $userData['password']))
        {
            $_SESSION['user'] = [
                "id" => $userData['id'],
                "firstname" => $userData['firstname'],
                "lastname" => $userData['lastname'],
                "email" => $userData['email'],
                "username" => $userData['username'],
                "bio" => $userData['bio'],
                "picture" => $userData['picture']
            ];

            redirect('/index.php');
        }
        //Redirecting back to login page if the password and email doesn't match
        else {
            redirect('/login.php');
        }
    }
}
