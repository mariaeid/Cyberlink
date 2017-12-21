<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Login of users

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users where email = :email");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //Redirecting back to login page if the email address doesn't exist
    if (empty($user)) {
        redirect('/login.php');
    }
    //If the email address exists and the password match we store the user details in a session and redirects the user to the start page
    else {
        if (password_verify($password, $user['password']))
        {
            unset($user['password']);

            $_SESSION['user'] = $user;

            redirect('/index.php');
        }
        //Redirecting back to login page if the password and email doesn't match
        else {
            redirect('/login.php');
        }
    }
}
