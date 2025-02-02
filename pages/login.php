<?php

$username_err = $passwd_err = '';

if (isset($_POST['username']) && isset($_POST['passwd'])) {
  $username = $_POST['username'];
  $passwd = $_POST['passwd'];
  if (usernameExists($username)) {
    if (logUserIn($username, $passwd)) {
      header('Location: ./?page=dashboard');
    } else {
      $passwd_err = 'Password not match';
    }
  } else {
    $username_err = 'Username not found';
  }
}
?>
<form action="./?page=login" method="post" class="w-50 mx-auto">
  <h1>Login Page</h1>
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
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Login</button>
</form>