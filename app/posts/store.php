<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Adding new post in the database.
if (isset($_POST['store'])) {
    if (isset($_POST['title'], $_POST['url'], $_POST['description'])) {
        $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
        $url = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
        $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare("INSERT INTO posts (title, url, description, post_user_id) VALUES (:title, :url, :description, :user_id)");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_STR);

        $statement -> execute();

        redirect('/../../index.php');
    }
}

// Cancel of creating post
if (isset($_POST['cancel'])) {
    redirect('../../index.php');
}
