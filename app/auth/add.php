<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Creation of new user
if (isset($_POST['add'])) {
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['confirmPassword'])) {
        $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
        $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Fetching users with same email or username as the one entered by the user
        $query = $pdo->query('SELECT * FROM users WHERE email = :email OR username = :username');

        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        $userEmail = $user['email'];
        $userUsername = $user['username'];

        // Saving the entered userdata into a session (to be used to fill in the form with data already entered by the user if errors)
        $_SESSION['save']['firstnameSave'] = $firstname;
        $_SESSION['save']['lastnameSave'] = $lastname;
        $_SESSION['save']['emailSave'] = $email;
        $_SESSION['save']['usernameSave'] = $username;

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
            // Adding the user to the database if the pw entered matches with the confirmed pw
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

                // Fetching the new userdata and updates the session with it
                $statement = $pdo->query('SELECT * FROM users WHERE  username= :username');
                $statement->bindParam(':username', $username, PDO::PARAM_STR);
                $statement->execute();

                $user = $statement->fetch(PDO::FETCH_ASSOC);

                unset($user['password']);
                $_SESSION['user'] = $user;

                redirect('../../profile.php');
            }
            else {
                // Saving error session if the pw don't match with the confirm pw
                $_SESSION['error'] = "The password don't match. Please enter again";
                redirect('../../signup.php');
            }

        }

    }
}
// Cancel of sign up
if (isset($_POST['cancel'])) {
    redirect('../../profile.php');
}
