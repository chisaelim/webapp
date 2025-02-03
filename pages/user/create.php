<?php

$user_label_err = $username_err = $passwd_err = $confirm_passwd_err = '';
if (isset($_POST['user_label']) && isset($_POST['username']) && isset($_POST['passwd']) && isset($_POST['confirm_passwd'])) {
    $user_label = $_POST['user_label'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $confirm_passwd = $_POST['confirm_passwd'];

    if (empty($user_label)) {
        $user_label_err = 'User Label is required';
    }
    if (empty($username)) {
        $username_err = 'Username is required';
    } else {
        if (usernameExists($username)) {
            $username_err = 'Username already exists';
        }
    }
    if (empty($passwd)) {
        $passwd_err = 'Password is required';
    } else {
        if (empty($confirm_passwd)) {
            $confirm_passwd_err = 'Confirm Password is required';
        } else {
            if ($passwd !== $confirm_passwd) {
                $confirm_passwd_err = 'Password not match';
            }
        }
    }
    if (empty($user_label_err) && empty($username_err) && empty($passwd_err) && empty($confirm_passwd_err)) {
        if (createUser($user_label, $username, $passwd)) {
            echo '<div class="alert alert-success" role="alert">
            User Created Successfully. <a href="./?page=user/home">User page</a>
            </div>';
            $user_label_err = $username_err = $passwd_err = $confirm_passwd_err = '';
            unset($_POST['user_label']);
            unset($_POST['username']);
            unset($_POST['passwd']);
            unset($_POST['confirm_passwd']);
        } else {
            echo '<div class="alert alert-danger" role="alert">
        User Added Failed
        </div>';
        }
    }
}


?>
<form action="./?page=user/create" method="post" class="w-50 mx-auto">
    <h1>Create User</h1>
    <div class="mb-3">
        <label for="user_label" class="form-label">User Label</label>
        <input type="text" name="user_label" class="form-control <?php echo $user_label_err !== '' ?  'is-invalid' : ' ' ?>" id="username" value="<?php echo isset($_POST['user_label']) ? $_POST['user_label'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $user_label_err ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control <?php echo $username_err !== '' ?  'is-invalid' : ' ' ?>" id="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $username_err ?>
        </div>
    </div>
    <div class=" mb-3">
        <label for="passwd" class="form-label">Password</label>
        <input type="password" name="passwd" class="form-control  <?php echo $passwd_err !== '' ? 'is-invalid' : ' ' ?>" id="passwd" value="<?php echo isset($_POST['passwd']) ? $_POST['passwd'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $passwd_err ?>
        </div>
    </div>
    <div class=" mb-3">
        <label for="confirm_passwd" class="form-label">Confirm Password</label>
        <input type="password" name="confirm_passwd" class="form-control  <?php echo $confirm_passwd_err !== '' ? 'is-invalid' : ' ' ?>" id="confirm_passwd" value="<?php echo isset($_POST['confirm_passwd']) ? $_POST['confirm_passwd'] : '' ?>">
        <div class="invalid-feedback">
            <?php echo $confirm_passwd_err ?>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <a role="button" href="./?page=user/home" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form>