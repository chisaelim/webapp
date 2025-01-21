<?php
require_once('init/init.php'); // initialize

include('includes/header.inc.php');
include('includes/navbar.inc.php');
if (isset($_GET['page'])) {
    $page = $_GET['page']; // about

    $before_login_pages = ['login', 'register'];
    $after_login_pages = ['dashboard'];

    if (
        $page === 'logout' ||
        (in_array($page, $before_login_pages) && !LoggedInUser()) ||
        (in_array($page, $after_login_pages) && LoggedInUser())
    ) {
        include('pages/' . $page . '.php');
    } else {
        header('Location: ./');
    }
} else {
    include('pages/home.php');
}
include('includes/footer.inc.php');

$db->close();
