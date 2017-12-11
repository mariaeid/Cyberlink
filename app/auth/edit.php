<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Edit of user profile details

if (isset($_POST['edit'])) {
    $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
    $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // echo $firstname. ' '.$lastname. ' '.$email.' '.$username.' '.$bio;

    $statement = $pdo->prepare("UPDATE users SET firstname, lastname, email, username, password) VALUES (:firsname, :lastname, :email, :username, :password)");

    if (!$statement) {
      die(var_dump(
          $pdo->errorInfo()
      ));
    }
}
