<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $statement = $pdo->prepare("SELECT * FROM users where id = :id");

    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

      if (password_verify($currentPassword, $user['password']))
      {
          if ($newPassword === $confirmPassword) {
            echo "correct";
            $password = password_hash($newPassword, PASSWORD_DEFAULT);

            $statement = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");

              if (!$statement) {
                  die(var_dump(
                      $pdo->errorInfo()
                  ));
              }

              $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
              $statement->bindParam(':password', $password, PDO::PARAM_STR);

              $statement->execute();

              $newData = $pdo->prepare("SELECT * FROM users where id = :id");
              $newData->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
              $newData->execute();
              $user = $newData->fetch(PDO::FETCH_ASSOC);

              unset($user['password']);

              $_SESSION['user'] = $user;

              redirect('../../profile.php');
            }
      }

      else {
          echo "Not correct";
      }

}


// Försök att verifiera lösen
// if (isset($_POST['currentPassword'])) {
//     $currentPassword = password_hash($_POST['currentPassword'], PASSWORD_DEFAULT);
//
//     $statement = $pdo->prepare("SELECT * FROM users where id = :id");
//     $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
//     $statement->execute();
//     $userData = $statement->fetch(PDO::FETCH_ASSOC);
//
//     $oldPassword = $userData['password'];
//
//     var_dump($oldPassword);
//     var_dump($currentPassword);
//
//     if(password_verify($oldPassword, $currentPassword)) {
//       echo "Correct";
//     }
// }
