<?php

declare(strict_types=1);
require __DIR__.'/../autoload.php';

$errorCurrent = "";
$errorNew = "";

if (isset($_POST['editPw'])) {

    if (isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        $statement = $pdo->prepare("SELECT * FROM users where id = :id");

        $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //Verification to see that the entered new pw matches the user's pw
        if (password_verify($currentPassword, $user['password']))
        {
            //If the user has repeated the new pw correctly the new pw is saved
            if ($newPassword === $confirmPassword) {
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

                //Store new session with user details (except pw), empty error variables & redirects to the profile page
                unset($user['password']);
                $_SESSION['user'] = $user;

                $errorCurrent = "";
                $errorNew = "";

                redirect('../../profile.php');
            }

            //Saving variable if new pw doesn't match with confirmed new pw
            else {
                $errorNew = "The new password doesn't match. Please enter again";
            }
        }

        //Saving variable if wrong current pw has been entered
        else {
            $errorCurrent = "The current password is not correct, please try again";
        }

    }
}

if (isset($_POST['cancel'])) {
    redirect('../../profile.php');
}
