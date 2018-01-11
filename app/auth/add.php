<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Creation of new user

// if (isset($_POST['add'])) {
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword'])) {
        $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
        $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $query = $pdo->query('SELECT * FROM users WHERE email = :email OR username = :username');

        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        $userEmail = $user['email'];
        $userUsername = $user['username'];

        $_SESSION['firstnameSave'] = $firstname;
        $_SESSION['lastnameSave'] = $lastname;
        $_SESSION['emailSave'] = $email;
        $_SESSION['usernameSave'] = $username;

        //Saving error session if the email already exists
        if ($userEmail === $email) {
            $_SESSION['error'] = "The email address already exists";
            redirect('../../signup.php');
        }
        //Saving error session if the username already exists
        elseif ($userUsername === $username) {
            $_SESSION['error'] = "The username already exists";
            redirect('../../signup.php');
        }
        else {
            if ($password === $confirmPassword) {
                $password = password_hash($password, PASSWORD_DEFAULT);

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

                // if (!$user) {

                    $statement = $pdo->query('SELECT * FROM users WHERE  username= :username');
                    $statement->bindParam(':username', $username, PDO::PARAM_STR);
                    $statement->execute();

                    $user = $statement->fetch(PDO::FETCH_ASSOC);

                    unset($user['password']);
                    $_SESSION['user'] = $user;

                    redirect('../../profile.php');
                // }
            }
            else {
                $_SESSION['error'] = "The password don't match. Please enter again";
                redirect('../../signup.php');
            }

        }

    }
// }
