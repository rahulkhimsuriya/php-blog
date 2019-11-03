<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fab fa-gripfire text-danger"></i> BLOG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarToggle">
      <ul class="nav navbar-nav ">
        <?php if (!Authenticated()) : ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Sign in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>

  </div>
</nav>
