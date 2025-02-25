<?php
function categoryNameExists($name)
{
    global $db;
    $query = $db->query("SELECT id_category FROM tbl_category WHERE name = '$name'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}
function categorySlugExists($slug)
{
    global $db;
    $query = $db->query("SELECT id_category FROM tbl_category WHERE slug = '$slug'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}

function getCategories()
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_category");
    if ($query->num_rows) {
        return $query;
    }
    return null;
}

function createCategory($name, $slug)
{
    global $db;
    $query = $db->prepare("INSERT INTO tbl_category (name,slug) VALUES ('$name','$slug')");
    if ($query->execute()) {
        return true;
    }
    return false;
}

function getCategoryByID($id)
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_category WHERE id_category = '$id'");
    if ($query->num_rows) {
        return $query->fetch_object();
    }
    return null;
}

function updateCategory($id, $name, $slug)
{
    global $db;
    $db->query("UPDATE tbl_category SET name = '$name', slug = '$slug' WHERE id_category = '$id'");
    if ($db->affected_rows) {
        return getCategoryByID($id);
    }
    return false;
}

function deleteCategory($id)
{
    global $db;
    $db->query("DELETE FROM tbl_category WHERE id_category ='$id'");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}
