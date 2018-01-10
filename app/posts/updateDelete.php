<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Update of posts in the database (applies when clicking on edit).

if (isset($_POST['edit'])) {
    if (isset($_POST['title'], $_POST['url'], $_POST['description'])) {
        $title = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING);
        $url = filter_var(trim($_POST['url']), FILTER_SANITIZE_STRING);
        $description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);

        $statement = $pdo->prepare("UPDATE posts SET title = :title, url = :url, description = :description WHERE post_id = :id");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':url', $url, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

        $statement->execute();

        $newData = $pdo->prepare("SELECT * from posts where post_id = :id");
        $newData->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
        $newData->execute();

        $post = $newData->fetch(PDO::FETCH_ASSOC);

        redirect('/../../submissions.php');
    }
}

// Deletion of posts in the database (applies when clicking on delete).

if (isset($_POST['delete'])) {
    $statement = $pdo->prepare("DELETE FROM posts WHERE post_id = :id");

        if (!$statement) {
          die(var_dump(
              $pdo->errorInfo()
          ));
        }

    $statement->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

    $statement -> execute();
    redirect('../../submissions.php');
}

if (isset($_POST['cancel'])) {
    redirect('../../submissions.php');
}
