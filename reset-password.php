<?php
include_once("config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "models/auth.php");

// If already logged in 
if (isset($_SESSION['is_user_login'])) {
  header("LOCATION: " . BASE_URL . 'dashboard.php');
  exit;
}

// Reset Password Functionality 
if (isset($_POST['submit'])) {
  $res = resetPassword($conn, $_POST);
  // echo "<Pre>";print_r($res); exit;
  if ($res['status'] == true) {
    $_SESSION['success'] = $res['message'];
    header("LOCATION: " . BASE_URL);
    exit;
  } else {
    $_SESSION['error'] = $res['message'];
    header("LOCATION: " . BASE_URL . 'reset-password.php');
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="./assect/CSS/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./assect/CSS/style.css" />
  <title>Reset-Password | Library</title>
</head>

<body style="background: #232529">
  <div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="row">
      <div class="col-md-12 login-form">
        <div class="card mb-3" style="max-width: 900px">
          <div class="row g-0">
            <div class="col-md-5">
              <img src="./assect/IMG/library.jpeg" class="img-fluid rounded-start" alt="..." />
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h1 class="card-title text-uppercase">Star Library</h1>
                <p class="card-text">Reset Password</p>
                <?php
                include_once(DIR_URL . "include/alerts.php");
                ?>
                <form method="post" action="<?php echo BASE_URL ?>reset-password.php">
                  <div class="mb-3">
                    <label class="form-label">Reset password code</label>
                    <input type="text" class="form-control" id="exampleInputEmailRE" name="reset_code" />
                    <p class="error" id="emailERE"></p>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">New password
                    </label>
                    <input type="password" class="form-control" id="exampleInputEmailNP" name="password" />
                    <p class="error" id="emailENP"></p>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="exampleInputEmailNPC" name="conf_pass" />
                    <p class="error" id="emailENPC"></p>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary">
                    Submit
                  </button>
                </form>
                <hr />
                <a href="./index.php" class="card-link link-underline-light">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./assect/JS/script.js"></script>
  <script src="./assect/JS/bootstrap.bundle.min.js"></script>
  <script src="./assect/JS/fc92123054.js" crossorigin="anonymous"></script>
</body>

</html>