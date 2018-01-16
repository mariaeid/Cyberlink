<?php
require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * FROM posts JOIN users ON posts.post_user_id=users.user_id");
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<article>
    <h1>Your Posts</h1>
        <?php foreach ($posts as $post): ?>
            <!-- Display posts crteated by the logged in user -->
            <?php if ($post['post_user_id'] === $_SESSION['user']['user_id']):?>
                <form action="/postEdit.php" method="post">
                    <div class="form-group border border-dark p-3 posts infoContainer">
                        <a href="<?php echo $post['url']; ?>"target="_blank"><?php echo $post['title']; ?></a>
                        <p><?php echo $post['description']; ?></p>
                        <p>Submitted by <?php echo $post['username']; ?></p>
                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                        <button type="submit" name="postEdit" class="btn btnColor btn-sm">Edit</button>
                    </div>
                </form>
            <?php endif; ?>
        <?php endforeach; ?>
</article>
<article>
    <form action="/newpost.php" method="post">
        <div class="form-group">
            <button type="submit" name="newLink" class="btn btn-light">Add a new post</button>
        </div>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
