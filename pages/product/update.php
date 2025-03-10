<?php
if (!isset($_GET['id']) || getProductByID($_GET['id']) === null) {
    header('Location: ./?page=category/home');
}

$manage_product = getProductByID($_GET['id']);

$name_err = $slug_err = $price_err = $short_des_err = $long_des_err = $image_err = '';

if (isset($_POST['name']) && isset($_POST['slug']) && isset($_POST['price']) && isset($_POST['short_des']) && isset($_POST['long_des'])) {
    $id_product = $_GET['id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $short_des = $_POST['short_des'];
    $long_des = $_POST['long_des'];
    $id_categories = isset($_POST['id_categories']) ? $_POST['id_categories'] : [];
    $image = $_FILES['image'];

    if (empty($name)) {
        $name_err = 'Name is required';
    } else {
        if ($name !== $manage_product->name && productNameExists($name)) {
            $name_err = 'Slug already exists';
        }
    }
    if (empty($slug)) {
        $slug_err = 'Name is required';
    } else {
        if ($slug !== $manage_product->slug && productSlugExists($slug)) {
            $slug_err = 'Slug already exists';
        }
    }

    if (empty($price)) {
        $price_err = 'Price is required';
    } else {
        if ($price < 0) {
            $price_err = 'Price must not be lower than zero';
        }
    }
    if (empty($short_des)) {
        $short_des_err = 'Short description is required';
    }
    if (empty($long_des)) {
        $long_des_err = 'Long description is required';
    }

    if (empty($name_err) && empty($slug_err) && empty($price_err) && empty($short_des_err) && empty($long_des_err)) {
        try {
            $manage_product = updateProduct($id_product, $name, $slug, $price, $short_des, $long_des, $image, $id_categories);
            if ($manage_product) {
                echo '<div class="alert alert-success" role="alert">
                Product Updated Successfully. <a href="./?page=product/home">Product page</a>
                </div>';
                $name_err = $slug_err = $price_err = $short_des_err = $long_des_err = '';
                unset($_POST['name']);
                unset($_POST['slug']);
                unset($_POST['price']);
                unset($_POST['short_des']);
                unset($_POST['long_des']);
                unset($_POST['id_categories']);
            } else {
                echo '<div class="alert alert-danger" role="alert">
                    Product Updated Failed
                    </div>';
            }
        } catch (Exception $th) {
            $image_err = $th->getMessage();
        }
    }
}

$product_categories = getProductCategories($_GET['id']);

$id_product_categories = [];
if ($product_categories !== null) {
    while ($row = $product_categories->fetch_object()) {
        $id_product_categories[] = $row->id_category;
    }
}
?>
<form action="./?page=product/update&id=<?php echo $_GET['id'] ?>" method="post" class="w-50 mx-auto" enctype="multipart/form-data">
    <h1>Update Product</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control <?php echo $name_err !== '' ?  'is-invalid' : ' ' ?>" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $manage_product->name ?>">
        <div class="invalid-feedback">
            <?php echo $name_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control <?php echo $slug_err !== '' ?  'is-invalid' : ' ' ?>" value="<?php echo isset($_POST['slug']) ? $_POST['slug'] : $manage_product->slug ?>">
        <div class="invalid-feedback">
            <?php echo $slug_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" class="form-control <?php echo $price_err !== '' ?  'is-invalid' : ' ' ?>" value="<?php echo isset($_POST['price']) ? $_POST['price'] : $manage_product->price ?>">
        <div class="invalid-feedback">
            <?php echo $price_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="short_des" class="form-label">Short Description</label>
        <textarea name="short_des" class="form-control <?php echo $short_des_err !== '' ?  'is-invalid' : ' ' ?>"><?php echo isset($_POST['short_des']) ? $_POST['short_des'] : $manage_product->short_des ?></textarea>

        <div class="invalid-feedback">
            <?php echo $short_des_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="long_des" class="form-label">Long Description</label>
        <textarea name="long_des" class="form-control <?php echo $long_des_err !== '' ?  'is-invalid' : ' ' ?>"><?php echo isset($_POST['long_des']) ? $_POST['long_des'] : $manage_product->long_des ?></textarea>

        <div class="invalid-feedback">
            <?php echo $long_des_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="product-image" class="form-label">Select Product Image</label>
        <input name="image" class="form-control <?php echo $image_err !== '' ?  'is-invalid' : ' ' ?>" type="file" id="product-image">
        <div class="invalid-feedback">
            <?php echo $image_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label>Categories</label>
        <?php
        $manage_categories = getCategories();
        if ($manage_categories !== null) {
            while ($row = $manage_categories->fetch_object()) {
                $checked = in_array($row->id_category, $id_product_categories) ? 'checked' : '';
        ?>
                <div class="form-check">
                    <input <?php echo $checked ?> name="id_categories[]" class="form-check-input" type="checkbox" value="<?php echo $row->id_category ?>" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        <?php echo $row->name ?>
                    </label>
                </div>
        <?php
            }
        }
        ?>

    </div>
    <div class="d-flex justify-content-between">
        <a role="button" href="./?page=product/home" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</form>