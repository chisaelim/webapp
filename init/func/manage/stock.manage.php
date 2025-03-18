<?php


function getStocks()
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_stock");
    if ($query->num_rows) {
        return $query;
    }
    return null;
}

function createStock($id_product, $qty, $date)
{
    global $db;
    $query = $db->prepare("INSERT INTO tbl_stock (id_product,qty,date) VALUES ('$id_product','$qty','$date')");
    if ($query->execute()) {
        return true;
    }
    return false;
}

function getStockByID($id)
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_stock WHERE id_stock = '$id'");
    if ($query->num_rows) {
        return $query->fetch_object();
    }
    return null;
}

function updateStock($id, $id_product, $qty, $date)
{
    global $db;
    $db->query("UPDATE tbl_stock SET id_product = '$id_product', qty = '$qty', date = '$date' WHERE id_stock = '$id'");
    if ($db->affected_rows) {
        return getStockByID($id);
    }
    return false;
}

function deleteStock($id)
{
    global $db;
    $db->query("DELETE FROM tbl_stock WHERE id_stock ='$id'");
    if ($db->affected_rows) {
        return true;
    }
    return false;
}
