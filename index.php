<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <?php if (!isset($_SESSION['user'])): ?>
        <p>This is the home page.</p>
    <?php else : ?>
        <p>Welcome <?php echo $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'] ?></p>
    <?php endif; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
