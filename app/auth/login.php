<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Login of user

$errorEmail = "";
$errorPw = "";

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users where email = :email");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //Saving error variable if the email address doesn't exist
    if (empty($user)) {
        $errorEmail = "There is no registered user on this email address";
    }
    //If the email address exists and the password match we store the user details (except for the pw) in a session, remove the errors and redirects the user to the start page
    else {
        if (password_verify($password, $user['password']))
        {
            unset($user['password']);
            $_SESSION['user'] = $user;

            $errorEmail = "";
            $errorPw = "";

            redirect('/index.php');
        }
        //Saving error variable if the password and email don't match
        else {
            $errorPw = "The password is not correct";
        }
    }
}
