<?php
$user = LoggedInUser();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="./">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <?php
        if (isAdmin()) {
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Manage
            </a>
            <ul class="dropdown-menu">

              <li><a class="dropdown-item" href="./?page=user/home">User Accouts</a></li>
              <li><a class="dropdown-item" href="./?page=category/home">Category Page</a></li>
              <li><a class="dropdown-item" href="./?page=product/home">Product Page</a></li>
              <li><a class="dropdown-item" href="./?page=stock/home">Stock Page</a></li>
            </ul>
          </li>
        <?php
        }
        ?>

        <?php
        if (isUser()) {
        ?>
          <li class="nav-item">
            <a href="./?page=cart/home" class="btn btn-primary">
              Cart <span class="badge text-bg-secondary">0</span>
            </a>
          </li>
        <?php
        }
        ?>



        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo (!$user ? 'Account' : $user->user_label) ?>
          </a>
          <ul class="dropdown-menu">
            <?php if (!$user) { ?>
              <li><a class="dropdown-item" href="./?page=login">Login</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>

              <li><a class="dropdown-item" href="./?page=register">Register</a></li>
            <?php } else { ?>
              <li><a class="dropdown-item" href="./?page=logout">Logout</a></li>
            <?php } ?>
          </ul>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>