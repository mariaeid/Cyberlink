<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

//Redirection to edit profile page
if (isset($_POST['profile'])) {
    redirect('/profileEdit.php');
}

//Edit of user profile details

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'],$_POST['username'], $_POST['bio'])) {
    $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
    $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, username = :username, bio = :bio WHERE id = :id");

    if (!$statement) {
      die(var_dump(
          $pdo->errorInfo()
      ));
    }

    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);

    $statement->execute();

    $newData = $pdo->prepare("SELECT * FROM users where id = :id");
    $newData->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $newData->execute();
    $userData = $newData->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user'] = [
        "id" => $userData['id'],
        "firstname" => $userData['firstname'],
        "lastname" => $userData['lastname'],
        "email" => $userData['email'],
        "username" => $userData['username'],
        "bio" => $userData['bio'],
        "picture" => $userData['picture'],
    ];

    redirect('../../profile.php');
}
