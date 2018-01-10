<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect($path)
    {
        header("Location: ${path}");
        exit;
    }
}

function allPosts($pdo) {
    $statement = $pdo->prepare("SELECT * FROM posts");

    if (!$statement) {
        die(var_dump(
            $pdo->errorInfo()
        ));
    }

    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function allVotes($pdo, $postID, $direction) {
    $statement = $pdo->query("SELECT COUNT(*) FROM votes WHERE direction='$direction' AND vote_post_id = :post_id");

    if (!$statement) {
        die(var_dump(
            $pdo->errorInfo()
        ));
    }

    $statement->bindParam(':post_id', $postID, PDO::PARAM_STR);
    $statement->execute();
    $votes = $statement->fetch(PDO::FETCH_ASSOC);
    return $votes;
}

function allUserVotes($pdo, $postID, $direction, $username) {
    $statement = $pdo->query("SELECT * FROM votes WHERE direction='$direction' AND vote_post_id = :post_id AND vote_username = :username");

    if (!$statement) {
        die(var_dump(
            $pdo->errorInfo()
        ));
    }

    $statement->bindParam(':post_id', $postID, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();
    $votesUser = $statement->fetch(PDO::FETCH_ASSOC);
    return $votesUser;
}
