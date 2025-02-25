<?php

$name_err = $slug_err = $price_err = $short_des_err = $long_des_err = '';
if (isset($_POST['name']) && isset($_POST['slug']) && isset($_POST['price']) && isset($_POST['short_des']) && isset($_POST['long_des'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $price = $_POST['price'];
    $short_des = $_POST['short_des'];
    $long_des = $_POST['long_des'];
    $id_categories = isset($_POST['id_categories']) ? $_POST['id_categories'] : [];

    if (empty($name)) {
        $name_err = 'Name is required';
    } else {
        if (productNameExists($name)) {
            $name_err = 'Name already exists';
        }
    }
    if (empty($slug)) {
        $slug_err = 'Slug is required';
    } else {
        if (productSlugExists($slug)) {
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
        if (createProduct($name, $slug, $price, $short_des, $long_des, $id_categories)) {
            echo '<div class="alert alert-success" role="alert">
            Product Created Successfully. <a href="./?page=product/home">Product page</a>
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
            Product Created Failed
            </div>';
        }
    }
}


?>
<form action="./?page=product/create" method="post" class="w-50 mx-auto">
    <h1>Create Product</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control <?php echo $name_err !== '' ?  'is-invalid' : ' ' ?>" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $name_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control <?php echo $slug_err !== '' ?  'is-invalid' : ' ' ?>" value="<?php echo isset($_POST['slug']) ? $_POST['slug'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $slug_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" class="form-control <?php echo $price_err !== '' ?  'is-invalid' : ' ' ?>" value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $price_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="short_des" class="form-label">Short Description</label>
        <textarea name="short_des" class="form-control <?php echo $short_des_err !== '' ?  'is-invalid' : ' ' ?>"><?php echo isset($_POST['short_des']) ? $_POST['short_des'] : '' ?></textarea>

        <div class="invalid-feedback">
            <?php echo $short_des_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="long_des" class="form-label">Long Description</label>
        <textarea name="long_des" class="form-control <?php echo $long_des_err !== '' ?  'is-invalid' : ' ' ?>"><?php echo isset($_POST['long_des']) ? $_POST['long_des'] : '' ?></textarea>

        <div class="invalid-feedback">
            <?php echo $long_des_err ?>
        </div>
    </div>

    <div class="mb-3">
        <label>Categories</label>
        <?php
        $manage_categories = getCategories();
        if ($manage_categories !== null) {
            while ($row = $manage_categories->fetch_object()) {
        ?>
                <div class="form-check">
                    <input name="id_categories[]" class="form-check-input" type="checkbox" value="<?php echo $row->id_category ?>" id="flexCheckDefault">
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
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form>