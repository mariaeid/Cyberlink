<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/store.php';
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
        <div class="form-group border border-info p-3">
            <a href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['title']; ?></a>
            <p><?php echo $post['description']; ?></p>
            <p>Submitted by <?php echo $post['username']; ?></p>
        </div>
    <?php endforeach; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
