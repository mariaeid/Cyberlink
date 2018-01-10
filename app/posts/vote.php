<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we handle up and down votes on posts.

//Fetching user vote

$query = $pdo->query('SELECT * from votes WHERE vote_username = :username AND vote_post_id = :post_id');
$query->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
$query->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);
$query->execute();
$vote = $query->fetch(PDO::FETCH_ASSOC);

$voteID = $vote['vote_id'];
$votePost_id = $vote['vote_post_id'];
$voteUsername = $vote['vote_username'];
$voteDirection = $vote['direction'];

// Voting up:

$votedUp = "";

if (isset($_POST['up'])) {

    if ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '1') {
        $votedUp = "You have aldready voted up on this link";
    }
    elseif ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '-1') {
        $statement = $pdo->prepare("UPDATE votes SET direction = '1' WHERE vote_id = :id");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':id', $voteID, PDO::PARAM_INT);

        $statement->execute();
    }

    else {
        $statement = $pdo->prepare("INSERT INTO votes (vote_username, vote_post_id, direction) VALUES (:username, :post_id, 1)");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
        $statement->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);

        $statement->execute();

    }
    redirect('/../../index.php');
}

// Voting down:

$votedDown = "";

if (isset($_POST['down'])) {

    if ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '-1') {
        $votedDown = "You have already voted down on this link";
    }
    elseif ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['username'] && $voteDirection === '1') {
        $statement = $pdo->prepare("UPDATE votes SET direction = '-1' WHERE vote_id = :id");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':id', $voteID, PDO::PARAM_INT);

        $statement->execute();

    }
    else {
        $statement = $pdo->prepare("INSERT INTO votes (vote_username, vote_post_id, direction) VALUES (:username, :post_id, -1)");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':username', $_SESSION['user']['username'], PDO::PARAM_STR);
        $statement->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);

        $statement->execute();
    }
    redirect('/../../index.php');
}
