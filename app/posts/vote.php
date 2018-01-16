<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we handle up and down votes on posts.

//Fetching user votes
$query = $pdo->query('SELECT * from votes WHERE vote_user_id = :username AND vote_post_id = :post_id');
$query->bindParam(':username', $_SESSION['user']['user_id'], PDO::PARAM_STR);
$query->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);
$query->execute();
$vote = $query->fetch(PDO::FETCH_ASSOC);

$voteID = $vote['vote_id'];
$votePost_id = $vote['vote_post_id'];
$voteUsername = $vote['vote_user_id'];
$voteDirection = $vote['direction'];

// Voting up:
$votedUp = ""; //To be used for check if the user aldready has voted up on the post

if (isset($_POST['up'])) {

    //Checking if the user aldready has voted up on the post by comparing vote id, logged in user and vote direction (up vote)
    if ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['user_id'] && $voteDirection === '1') {
        $votedUp = "You have aldready voted up on this link";
    }
    //If the user have voted down on the post the vote is updated to an up vote instead
    elseif ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['user_id'] && $voteDirection === '-1') {
        $statement = $pdo->prepare("UPDATE votes SET direction = '1' WHERE vote_id = :id");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':id', $voteID, PDO::PARAM_INT);

        $statement->execute();
    }

    // If the user hasn't voted on the post aldready an up vote is added
    else {
        $statement = $pdo->prepare("INSERT INTO votes (vote_user_id, vote_post_id, direction) VALUES (:username, :post_id, 1)");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':username', $_SESSION['user']['user_id'], PDO::PARAM_STR);
        $statement->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);

        $statement->execute();

    }
    redirect('/../../index.php');
}

// Voting down:
$votedDown = ""; //To be used for check if the user aldready has voted down on the post

if (isset($_POST['down'])) {

    //Checking if the user aldready has voted down on the post by comparing vote id, logged in user and vote direction (down vote)
    if ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['user_id'] && $voteDirection === '-1') {
        $votedDown = "You have already voted down on this link";
    }

    //If the user have voted up on the post the vote is updated to a down vote instead
    elseif ($votePost_id === $_POST['post_id'] && $voteUsername === $_SESSION['user']['user_id'] && $voteDirection === '1') {
        $statement = $pdo->prepare("UPDATE votes SET direction = '-1' WHERE vote_id = :id");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':id', $voteID, PDO::PARAM_INT);

        $statement->execute();

    }

    // If the user hasn't voted on the post aldready a down vote is added
    else {
        $statement = $pdo->prepare("INSERT INTO votes (vote_user_id, vote_post_id, direction) VALUES (:username, :post_id, -1)");

        if (!$statement) {
            die(var_dump(
                $pdo->errorInfo()
            ));
        }

        $statement->bindParam(':username', $_SESSION['user']['user_id'], PDO::PARAM_STR);
        $statement->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_STR);

        $statement->execute();
    }
    redirect('/../../index.php');
}
