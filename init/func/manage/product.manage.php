<?php
function getProducts()
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_product");
    if ($query->num_rows) {
        return $query;
    }
    return null;
}

function productNameExists($name)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE name = '$name'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}
function productSlugExists($slug)
{
    global $db;
    $query = $db->query("SELECT id_product FROM tbl_product WHERE slug = '$slug'");
    if ($query->num_rows) {
        return true;
    }
    return false;
}

function createProduct($name, $slug, $price, $short_des, $long_des, $image, $id_categories)
{
    $img_name = $image['name'];
    $img_size = $image['size'];
    $tmp_name = $image['tmp_name'];
    $error = $image['error'];

    $dir = './assets/images/';

    $allow_exs = ['pjg', 'png', 'pjeg'];
    if ($error !== 0) {
        throw new Exception('Unknown error occurred!');
    }

    if ($img_size > 500000) {
        throw new Exception('File size is too large!');
    }

    $image_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $image_lowercase_ex = strtolower($image_ex);

    if (!in_array($image_lowercase_ex, $allow_exs)) {
        throw new Exception('File extension is not allowed!');
    }

    $new_image_name = uniqid("PI-") . '.' . $image_lowercase_ex;
    $image_path = $dir . $new_image_name;
    move_uploaded_file($tmp_name, $image_path);

    global $db;
    $db->begin_transaction();
    try {
        $query = $db->prepare("INSERT INTO tbl_product (name,slug,price,qty,short_des,long_des,image) VALUES ('$name','$slug','$price',0,'$short_des','$long_des','$image_path')");
        if ($query->execute()) {
            $id_product = $query->insert_id;
            foreach ($id_categories as $id_category) {
                $query1 = $db->prepare("INSERT INTO tbl_product_category (id_category,id_product) VALUES ('$id_category','$id_product')");
                $query1->execute();
            }
            $db->commit();
            return true;
        }
    } catch (Exception $e) {
        $db->rollback();
        return false;
    }
}

function getProductByID($id)
{
    global $db;
    $query = $db->query("SELECT * FROM tbl_product WHERE id_product = '$id'");
    if ($query->num_rows) {
        return $query->fetch_object();
    }
    return null;
}

function deleteProduct($id)
{
    global $db;

    $product = getProductByID($id);
    // $db->query("DELETE FROM tbl_product_category WHERE id_product ='$id'");
    $db->query("DELETE FROM tbl_product WHERE id_product ='$id'");
    if ($db->affected_rows) {
        unlink($product->image); // path + filename
        return true;
    }
    return false;
}

