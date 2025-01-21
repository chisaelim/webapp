<?php $user = LoggedInUser() ?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li> -->
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
                        <!-- <li><a class="dropdown-item" href="/webapp/pages/register.php">Register</a></li> -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>