<?php
require_once('init/init.php'); // initialize

include('includes/header.inc.php');
include('includes/navbar.inc.php');
if (isset($_GET['page'])) {
    $page = $_GET['page']; // about
    $page_arr = ['login', 'register'];
    if (in_array($page, $page_arr)) {
        include('pages/' . $page . '.php');
    } else {
        header("Location: ./");
    }
} else {
    include('pages/home.php');
}
include('includes/footer.inc.php');

$db->close();
