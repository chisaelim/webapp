<?php

require_once('init/init.php');

include('includes/header.inc.php');
include('includes/navbar.inc.php');
if (isset($_GET['page'])) {
    $page = $_GET['page']; // about

    $before_logIn_pages = ['login', 'register'];
    $after_logIn_pages = [
        'dashboard',
        'user/home',
        'user/create',
        'user/update',
        'user/delete',
        'category/home',
        'category/create',
        'category/update',
        'category/delete',

    ];
    $admin_pages = [
        'user/home',
        'user/create',
        'user/update',
        'user/delete',
        'category/home',
        'category/create',
        'category/update',
        'category/delete',
    ];
    $user_page = [];
    if (
        $page === 'logout'  ||
        (in_array($page, $before_logIn_pages) && !LoggedInUser()) ||
        (in_array($page, $after_logIn_pages) && LoggedInUser())
    ) {
        if (in_array($page, $admin_pages) && !isAdmin()) {
            header("Location: ./");
        }
        include('pages/' . $page . '.php');
    } else {
        header("Location: ./");
    }
} else {
    include('pages/home.php');
}
include('includes/footer.inc.php');


$db->close();
