<nav class="navbar navbar-expand-lg navbar-dark bg-dark navStyle">
  <a class="navbar-brand navStyle" href="#"><img class="logo" src="/../app/imgs/site/logo.png"></a>

  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'active' : ''; ?>" href="/index.php">Home</a>
      </li><!-- /nav-item -->
      <li class="nav-item">
          <?php if (isset($_SESSION['user'])): ?>
              <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/submissions.php' ? 'active' : ''; ?>" href="/submissions.php"><?php echo "Your Posts" ?></a>
          <?php endif; ?>
      </li><!-- /nav-item -->
      <li class="nav-item">
          <?php if (isset($_SESSION['user'])): ?>
              <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/profile.php' ? 'active' : ''; ?>" href="/profile.php"><?php echo "Your Profile" ?></a>
          <?php endif; ?>
      </li><!-- /nav-item -->
      <li class="nav-item">
          <?php if (isset($_SESSION['user'])): ?>
              <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/logout.php' ? 'active' : ''; ?>" href="/app/auth/logout.php"><?php echo "Logout" ?></a>
          <?php else : ?>
              <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/login.php' ? 'active' : ''; ?>" href="/login.php">Login</a>
          <?php endif; ?>
      </li><!-- /nav-item -->
      <li class="nav-item">
          <?php if (!isset($_SESSION['user'])): ?>
              <a class="nav-link <?php echo $_SERVER['SCRIPT_NAME'] === '/signup.php' ? 'active' : ''; ?>" href="/signup.php"><?php echo "Sign Up" ?></a>
          <?php endif; ?>
      </li><!-- /nav-item -->
  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
