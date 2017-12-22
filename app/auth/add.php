<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Creation of new user
// OBS! Gör unset på password så det inte sparas om man behöver fylla i uppgifter igen!!

$emailExists = "";
$usernameExists = "";

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'])) {
    $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
    $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $pdo->query('SELECT * FROM users WHERE email = :email OR username = :username');

    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':username', $username, PDO::PARAM_STR);

    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    var_dump($user);

    $userEmail = $user['email'];
    $userUsername = $user['username'];
    if ($userEmail === $email) {
        $emailExists = "The email address already exists";
    }
    elseif ($userUsername === $username) {
        $usernameExists = "The username already exists";
    }
    else {

        $statement = $pdo->prepare("INSERT INTO users (firstname, lastname, email, username, password) VALUES (:firstname, :lastname, :email, :username, :password)");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);

        $statement -> execute();

        if (!$user) {
            $statement = $pdo->query('SELECT * FROM users WHERE  username= :username');
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            $_SESSION['user'] = $user;

            redirect('../../profile.php');

        }
    }

}
