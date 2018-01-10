<?php
require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * FROM posts");
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<article>
    <h1>Your Posts</h1>
        <?php foreach ($posts as $post): ?>
            <?php if ($post['post_username'] === $_SESSION['user']['username']):?>
                <form action="/submissionEdit.php" method="post">
                    <div class="form-group border border-info p-3 submissions">
                        <a href="<?php echo $post['url']; ?>"target="_blank"><?php echo $post['title']; ?></a>
                        <p><?php echo $post['description']; ?></p>
                        <p>Submitted by <?php echo $post['post_username']; ?></p>
                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                        <button type="submit" name="submissionEdit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
</article>
<article>
    <form action="/newSubmission.php" method="post">
        <div class="form-group">
            <button type="submit" name="newLink" class="btn btn-light">Add a new post</button>
        </div>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
