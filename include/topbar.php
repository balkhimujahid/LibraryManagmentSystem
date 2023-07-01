<!-- TOP NAVBAR START -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <!-- OFFCANVAS TRIGER START  -->
    <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- OFFCANVAS TRIGER END  -->
    <a class="navbar-brand text-uppercase fw-bold me-auto" href="#">star library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="d-flex ms-auto" role="search">
        <div class="input-group my-3 my-lg-0">
          <input type="text" class="form-control" placeholder="Search..." aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary btn-primary text-white" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
          </button>
        </div>
      </form>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($_SESSION['user']['profile_pic']) { ?>
              <img src="
                  <?php echo BASE_URL . 'assect/uploads/' . $_SESSION['user']['profile_pic'] ?>" class="user-icon" />
            <?php } else { ?>
              <img src="
                  <?php echo BASE_URL . 'assect/IMG/user.png' ?>" class="user-icon" />
            <?php } ?>
            Hi, <?php echo $_SESSION['user']['name'] ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>my-profile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL ?>my-profile.php">Change Password</a></li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li>
              <a class="dropdown-item" href="<?php echo BASE_URL ?>logout.php">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- TOP NAVBAR END -->