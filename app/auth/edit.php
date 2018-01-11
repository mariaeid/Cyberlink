<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

//Edit of user profile details

if (isset($_POST['edit'])) {
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['username'], $_POST['bio'])) {
        $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
        $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare("SELECT * FROM users where user_id != :id");
        $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $userEmail = $user['email'];
            $userUsername = $user['username'];
            $userID = $user['user_id'];

            if ($userEmail === $email && $userID !== $_SESSION['user']['user_id']) {
                $_SESSION['error'] = "The email address already exists";
                redirect('../../profileEdit.php');
            }

            elseif ($userUsername === $username && $userID !== $_SESSION['user']['user_id']) {
                $_SESSION['error'] = "The username  already exists";
                redirect('../../profileEdit.php');
            }
        }

        $statement = $pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, username = :username, bio = :bio WHERE user_id = :id");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);

        $statement->execute();

        $newData = $pdo->prepare("SELECT * FROM users where user_id = :id");
        $newData->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $newData->execute();

        $user = $newData->fetch(PDO::FETCH_ASSOC);
        unset($_SESSION['user']);
        $_SESSION['user'] = $user;
        redirect('../../profile.php');
    }
}

if (isset($_POST['cancel'])) {
    redirect('../../profile.php');
}
