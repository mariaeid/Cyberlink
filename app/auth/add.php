<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Creation of new user
// FRÅGA: Bör man kolla empty fields trots att det är gjort frontend??

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'])) {
  $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
  $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
  $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $statement = $pdo->prepare("INSERT INTO users (firstname, lastname, email, username, password) VALUES (:firstname, :lastname, :email, :username, :password)");

  $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
  $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->bindParam(':password', $password, PDO::PARAM_STR);

  if (!$statement) {
    die(var_dump(
        $pdo->errorInfo()
    ));
  }

  redirect('/index.php');

}
