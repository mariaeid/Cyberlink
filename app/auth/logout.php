<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Logout of users

//Removing user session and redirecting to startpage
unset($_SESSION['user']);
session_destroy();

redirect('/index.php');
