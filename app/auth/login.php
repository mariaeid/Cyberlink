<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Login of user

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users where email = :email");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //Saving error in a session if the email address doesn't exist
    if (empty($user)) {
        $_SESSION['error'] = "There is no registered user on this email address";
        redirect('/../../login.php');
    }
    //If the email address exists and the password match we store the user details (except for the pw) in a session, remove the errors and redirects the user to the start page
    else {
        if (password_verify($password, $user['password']))
        {
            unset($user['password']);
            $_SESSION['user'] = $user;

            redirect('/index.php');
        }
        //Saving error variable if the user password and email don't match
        else {
            $_SESSION['error'] = "The password is not correct";
            $_SESSION['emailSave'] = $email;
            redirect('/../../login.php');
        }
    }
}
