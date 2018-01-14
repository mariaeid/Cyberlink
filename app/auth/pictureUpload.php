<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

//Edit of user image

if (isset($_FILES['picture'])) {
   $picture = $_FILES['picture'];
   $info = pathinfo($_FILES['picture']['name']); //Creates the array from name
   $ext = $info['extension']; //Selects the extension from the array name
   $fileName = $_SESSION['user']['user_id'].'.'.$ext;

   move_uploaded_file($picture['tmp_name'], __DIR__.'/../imgs/avatar/'.$fileName);

   $statement = $pdo->prepare("UPDATE users SET picture = :picture WHERE user_id = :id");

   if (!$statement) {
     die(var_dump(
         $pdo->errorInfo()
     ));
   }

   $statement->bindParam(':picture', $fileName, PDO::PARAM_STR);
   $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
   $statement -> execute();

   $newData = $pdo->prepare("SELECT * FROM users where user_id = :id");
   $newData->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
   $newData->execute();

   $user = $newData->fetch(PDO::FETCH_ASSOC);

   $_SESSION['user'] = $user;

   redirect('../../profile.php');

 }
