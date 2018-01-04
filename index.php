<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/store.php';
require __DIR__.'/app/posts/vote.php';
?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <?php if (isset($_SESSION['user'])): ?>
        <p>Welcome <?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'] ?></p>
        <form action="/newSubmission.php" method="post">
            <div class="form-group">
                <button type="submit" name="newLink" class="btn btn-primary">Add link</button>
            </div>
        </form>
    <?php endif; ?>
</article>
<article>
    <?php foreach ($posts as $post): ?>
        <form action="/app/posts/vote.php" method="post">
            <div class="form-group border border-info p-3">
                <a href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['title']; ?></a>
                <p><?php echo $post['description']; ?></p>
                <p>Submitted by <?php echo $post['username']; ?></p>
                <?php if (isset($_SESSION['user'])):?>
                    <button class="fa fa-thumbs-o-up" aria-hidden="true" name="up"></button>
                    <?php
                        $queryUpVotes = $pdo->query('SELECT COUNT(*) FROM votes WHERE direction="1" AND post_id = :post_id');
                        $queryUpVotes->bindParam(':post_id', $post['id'], PDO::PARAM_STR);
                        $queryUpVotes->execute();
                        $upVotes = $queryUpVotes->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <p><?php echo $upVotes['COUNT(*)']; ?></p>
                    <button class="fa fa-thumbs-o-down" aria-hidden="true" name="down"></button>
                    <?php
                        $queryDownVotes = $pdo->query('SELECT COUNT(*) FROM votes WHERE direction="-1" AND post_id = :post_id');
                        $queryDownVotes->bindParam(':post_id', $post['id'], PDO::PARAM_STR);
                        $queryDownVotes->execute();
                        $downVotes = $queryDownVotes->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <p><?php echo $downVotes['COUNT(*)']; ?></p>
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <?php endif; ?>
            </div>
        </form>
    <?php endforeach; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
