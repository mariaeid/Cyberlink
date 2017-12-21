<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/store.php';
?>

<article>
    <h1><?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'];?></h1>

    <form action="/submissionEdit.php" method="post">

        <?php foreach ($posts as $post): ?>
            <?php if ($post['username'] === $_SESSION['user']['username']): ?>
                <div class="form-group border border-info p-3 submissions" data-id="<?php echo $post['id']; ?>">
                    <a href="<?php echo $post['url']; ?>"target="_blank"><?php echo $post['title']; ?></a>
                    <p><?php echo $post['description']; ?></p>
                    <p>Submitted by <?php echo $post['username']; ?></p>
                    <button type="submit" name="submissionEdit" class="btn btn-primary">Edit submission</button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
