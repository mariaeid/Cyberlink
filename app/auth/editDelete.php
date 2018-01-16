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

        // Fetching all users except for the one logged in
        $statement = $pdo->prepare("SELECT * FROM users where user_id != :id");
        $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $userEmail = $user['email'];
            $userUsername = $user['username'];
            $userID = $user['user_id'];

            // If the email entered by the user is equal to an existing email an error session is saved and the database is not updated
            if ($userEmail === $email) {
                $_SESSION['error'] = "The email address already exists";
                redirect('../../profileEdit.php');
            }

            // If the username enered by the user is equal to an existing username an error session is saved and the database is not updated
            elseif ($userUsername === $username) {
                $_SESSION['error'] = "The username  already exists";
                redirect('../../profileEdit.php');
            }
        }

        //Updating the database with the new user details
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

        // Fetching the new user details, updates the session with them and redirects the user to profile page
        $newData = $pdo->prepare("SELECT * FROM users where user_id = :id");
        $newData->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $newData->execute();

        $user = $newData->fetch(PDO::FETCH_ASSOC);
        unset($_SESSION['user']);
        $_SESSION['user'] = $user;
        redirect('../../profile.php');
    }
}

// Delete of account
if (isset($_POST['delete'])) {
    // Deleting user
    $statement = $pdo->prepare("DELETE FROM users WHERE user_id = :id");

        if (!$statement) {
          die(var_dump(
              $pdo->errorInfo()
          ));
        }

    $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);

    $statement -> execute();

    // Deleting the user's votes
    $statement = $pdo->prepare("DELETE FROM votes WHERE vote_user_id = :id");

        if (!$statement) {
          die(var_dump(
              $pdo->errorInfo()
          ));
        }

    $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);

    $statement -> execute();

    // Deliting the user's posts
    $statement = $pdo->prepare("DELETE FROM posts WHERE post_user_id = :id");

        if (!$statement) {
          die(var_dump(
              $pdo->errorInfo()
          ));
        }

    $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);

    $statement -> execute();

    // Removing user session and saved data
    unset($_SESSION['user']);
    unset($_SESSION['save']);
    redirect('../../index.php');
}

// Cancel of editing user detials
if (isset($_POST['cancel'])) {
    redirect('../../profile.php');
}
