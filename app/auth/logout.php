<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Logout of users

unset($_SESSION['user']);

redirect('/index.php');
