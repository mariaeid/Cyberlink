<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we store/insert new posts in the database.

$statement = $pdo->prepare("SELECT * FROM posts");
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['edit'])) {
    if (isset($_POST['title'], $_POST['url'], $_POST['description'])) {
        $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
        $url = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
        $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare("INSERT INTO posts (title, url, description, username) VALUES (:title, :url, :description, :username)");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);

        $statement -> execute();

        redirect('/../../index.php');
    }
}

if (isset($_POST['cancel'])) {
    redirect('../../index.php');
}
