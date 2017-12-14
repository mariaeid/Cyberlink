<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

//Edit of user image

if (isset($_FILES['picture'])) {
   $picture = $_FILES['picture'];
   $info = pathinfo($_FILES['picture']['name']); //Skapar array ur 'name'
   $ext = $info['extension']; //Väljer 'extension' ur 'name'
   $fileName = $_SESSION['user']['username'].'.'.$ext;

   move_uploaded_file($picture['tmp_name'], __DIR__.'/../imgs/'.$fileName);

   $statement = $pdo->prepare("UPDATE users SET picture = :picture WHERE id = :id");

   if (!$statement) {
     die(var_dump(
         $pdo->errorInfo()
     ));
   }

   $statement->bindParam(':picture', $fileName, PDO::PARAM_STR);
   $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
   $statement -> execute();

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
