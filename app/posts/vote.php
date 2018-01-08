<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we handle up and down votes on posts.

//Fetching user vote
if (isset($_SESSION['user'])){
    $query = $pdo->query('SELECT * from votes WHERE username = :username AND post_id = :post_id');

    $query->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
    $query->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);

    $query->execute();

    $vote = $query->fetch(PDO::FETCH_ASSOC);

    $voteID = $vote['id'];
    $votePost_id = $vote['post_id'];
    $voteUsername = $vote['username'];
    $voteDirection = $vote['direction'];

    // Voting up:

    $votedUp = "";

    if (isset($_POST['up'])) {

        if ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '1') {
            $votedUp = "You have aldready voted up on this link";
        }
        elseif ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '-1') {
            $statement = $pdo->prepare("UPDATE votes SET direction = '1' WHERE id = :id");

            if (!$statement) {
                die(var_dump(
                    $pdo->errorInfo()
                ));
            }

            $statement->bindParam(':id', $voteID, PDO::PARAM_INT);

            $statement->execute();
        }

        else {
            $statement = $pdo->prepare("INSERT INTO votes (username, post_id, direction) VALUES (:username, :post_id, 1)");

            if (!$statement) {
                die(var_dump(
                    $pdo->errorInfo()
                ));
            }

            $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
            $statement->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);

            $statement->execute();

        }
    }

    // Voting down:

    $votedDown = "";

    if (isset($_POST['down'])) {

        if ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '-1') {
            $votedDown = "You have already voted down on this link";
        }
        elseif ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '1') {
            $statement = $pdo->prepare("UPDATE votes SET direction = '-1' WHERE id = :id");

            if (!$statement) {
                die(var_dump(
                    $pdo->errorInfo()
                ));
            }

            $statement->bindParam(':id', $voteID, PDO::PARAM_INT);

            $statement->execute();

        }
        else {
            $statement = $pdo->prepare("INSERT INTO votes (username, post_id, direction) VALUES (:username, :post_id, -1)");

            if (!$statement) {
                die(var_dump(
                    $pdo->errorInfo()
                ));
            }

            $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
            $statement->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);

            $statement->execute();
        }
    }
}

$queryUpVotes = $pdo->query('SELECT COUNT(*) FROM votes WHERE direction="1" AND post_id = :post_id');
$queryUpVotes->bindParam(':post_id', $post['id'], PDO::PARAM_STR);
$queryUpVotes->execute();
$upVotes = $queryUpVotes->fetch(PDO::FETCH_ASSOC);
