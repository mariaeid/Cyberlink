<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
require __DIR__.'/store.php';

// In this file we count how many up/down votes each post has.

$queryAllVotes = $pdo->query('SELECT * from votes WHERE post_id = :post_id');

$queryAllVotes->bindParam(':post_id', $post['id'], PDO::PARAM_STR);

$queryAllVotes->execute();

$votes = $queryAllVotes->fetch(PDO::FETCH_ASSOC);
