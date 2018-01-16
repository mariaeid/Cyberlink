<?php

declare(strict_types=1);
require __DIR__.'/../autoload.php';

// Change of password
if (isset($_POST['editPw'])) {

    if (isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmPassword'])) {
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        $statement = $pdo->prepare("SELECT * FROM users where user_id = :id");

        $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //Verification to see that the entered new pw matches the user's current pw
        if (password_verify($currentPassword, $user['password']))
        {
            //If the user has repeated the new pw correctly the new pw is saved
            if ($newPassword === $confirmPassword) {
                $password = password_hash($newPassword, PASSWORD_DEFAULT);

                $statement = $pdo->prepare("UPDATE users SET password = :password WHERE user_id = :id");

                if (!$statement) {
                    die(var_dump(
                        $pdo->errorInfo()
                    ));
                }

                $statement->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
                $statement->bindParam(':password', $password, PDO::PARAM_STR);

                $statement->execute();

                $newData = $pdo->prepare("SELECT * FROM users where user_id = :id");
                $newData->bindParam(':id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
                $newData->execute();
                $user = $newData->fetch(PDO::FETCH_ASSOC);

                //Store new session with user details (except pw) & redirects to the profile page
                unset($user['password']);
                $_SESSION['user'] = $user;
                redirect('../../profile.php');
            }

            //Saving variable if new pw doesn't match with confirmed new pw
            else {
                $_SESSION['error'] = "The new password doesn't match. Please enter again";
                redirect('../../changePw.php');
            }
        }

        //Saving variable if wrong current pw has been entered
        else {
            $_SESSION['error'] = "The current password is not correct, please try again";
            redirect('../../changePw.php');
        }

    }
}

// Cancel of editing pw
if (isset($_POST['cancel'])) {
    redirect('../../profile.php');
}
