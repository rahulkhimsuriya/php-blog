<nav class="navbar navbar-expand-md navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fab fa-gripfire text-danger"></i> BLOG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarToggle">
      <ul class="nav navbar-nav ">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Post</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="createPost.php">Create New Post</a>
            <a class="dropdown-item" href="myPosts.php">Show My Posts</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">Logout</a>
        </li>
      </ul>
    </div>

  </div>
</nav>