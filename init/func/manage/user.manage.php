<?php
function getUsers()
{
    //admin // user
    global $db;
    $query = $db->query("SELECT id_user,user_label,level FROM tbl_user WHERE level = 'User'");
    if ($query->num_rows) {
        return $query;
    }
    return null;
}

function createUser($user_label, $username, $passwd)
{
    global $db;
    $query = $db->prepare("INSERT INTO tbl_user(user_label,username,passwd,level) VALUES ('$user_label','$username','$passwd','User')");
    if ($query->execute()) {
        return true;
    }
    return false;
}
