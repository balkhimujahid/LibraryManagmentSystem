<?php

include_once("config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "include/middleware.php");
include_once(DIR_URL . "models/dashboard.php");

$counts = getCounts($conn);
$tabs = getTabData($conn);


include_once(DIR_URL . "include/header.php");
include_once(DIR_URL . "include/sidebar.php");
include_once(DIR_URL . "include/topbar.php");

?>
<!-- MAIN CONTENT START  -->
<main class="mt-5 pt-3">
  <div class="container-fluid">
    <!-- CARDS -->
    <div class="row deshboard-counts">
      <div class="col-md-12">
        <h4 class="fw-bold text-uppercase">Dashboard</h4>
        <p>Statistics of the system</p>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase text-muted">Total books</h6>
            <h1><?php echo $counts['total_books'] ?></h1>
            <a href="<?php echo BASE_URL ?>books" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase text-muted">Total students</h6>
            <h1><?php echo $counts['total_students'] ?></h1>
            <a href="<?php echo BASE_URL ?>students" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase text-muted">Total revenue</h6>
            <h1><?php echo number_format($counts['total_revenue']) ?></h1>
            <a href="<?php echo BASE_URL ?>subscription/purchase-history.php" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase text-muted">Total books loan</h6>
            <h1><?php echo $counts['total_loans'] ?></h1>
            <a href="<?php echo BASE_URL ?>loans" class="card-link link-underline-light">View more</a>
          </div>
        </div>
      </div>
    </div>

    <!-- TABS -->
    <div class="row mt-5 deshboard-tabs">
      <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active text-uppercase" id="student-tab" data-bs-toggle="tab" data-bs-target="#student-tab-pane" type="button" role="tab" aria-controls="student-tab-pane" aria-selected="true">New Students</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link text-uppercase" id="load-tab" data-bs-toggle="tab" data-bs-target="#load-tab-pane" type="button" role="tab" aria-controls="load-tab-pane" aria-selected="false">Recent Loan</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link text-uppercase" id="sub-tab" data-bs-toggle="tab" data-bs-target="#sub-tab-pane" type="button" role="tab" aria-controls="sub-tab-pane" aria-selected="false">Recent Subscription</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="student-tab-pane" role="tabpanel" aria-labelledby="student-tab" tabindex="0">
            <table class="table">
              <thead class="table-dark">
                <tr>
                  <th scope="coll">#</th>
                  <th scope="coll">Name</th>
                  <th scope="coll">Phone No</th>
                  <th scope="coll">Registered On</th>
                  <th scope="coll">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($tabs['students'] as $st) {
                ?>
                  <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td><?php echo $st['name'] ?></td>
                    <td><?php echo $st['phone_no'] ?></td>
                    <td><?php echo date("d-m-Y H:i A", strtotime($st['name'])) ?></td>
                    <td>
                      <?php
                      if ($st['status'] == 1)
                        echo '<span class="badge text-bg-success">Active</span>';
                      else echo '<span class="badge text-bg-danger">Inactive</span>';
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="load-tab-pane" role="tabpanel" aria-labelledby="load-tab" tabindex="0">
            <table class="table">
              <thead class="table-dark">
                <tr>
                  <th scope="coll">#</th>
                  <th scope="coll">Book Name</th>
                  <th scope="coll">Student Name</th>
                  <th scope="coll">Loan Date</th>
                  <th scope="coll">Due Date</th>
                  <th scope="coll">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($tabs['loans'] as $l) {
                ?>
                  <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td><?php echo $l['book_title'] ?></td>
                    <td><?php echo $l['student_name'] ?></td>
                    <td><?php echo date("d-m-Y", strtotime($l['loan_date'])) ?></td>
                    <td><?php echo date("d-m-Y", strtotime($l['return_date'])) ?></td>
                    <td>
                      <?php
                      if ($l['is_return'] == 1)
                        echo '<span class="badge text-bg-success">Returned</span>';
                      else echo '<span class="badge text-bg-warning">Active</span>';
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="sub-tab-pane" role="tabpanel" aria-labelledby="sub-tab" tabindex="0">
            <table class="table">
              <thead class="table-dark">
                <tr>
                  <th scope="coll">#</th>
                  <th scope="coll">Student Name</th>
                  <th scope="coll">Amaount</th>
                  <th scope="coll">Start Date</th>
                  <th scope="coll">End Date</th>
                  <th scope="coll">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  $i = 1;
                  foreach ($tabs['subscription'] as $s) {
                  ?>
                <tr>
                  <th scope="row"><?php echo $i++ ?></th>
                  <td><?php echo $s['student_name'] ?></td>
                  <td>
                    <span class="badge text-bg-info me-1"><?php echo $s['plan_title'] ?></span>
                    <i class="fa-solid fa-indian-rupee-sign"><?php echo $s['amount'] ?></i>
                  </td>
                  <td><?php echo date("d-m-Y", strtotime($s['start_date'])) ?></td>
                  <td><?php echo date("d-m-Y", strtotime($s['end_date'])) ?></td>
                  <td>
                    <?php
                    $today = date("Y-m-d");
                    if ($s['end_date'] >= $today)
                      echo '<span class="badge text-bg-success">Active</span>';
                    else
                      echo '<span class="badge text-bg-danger">Expired</span>';
                    ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- TABS  -->
  </div>
</main>
<!-- MAIN CONTENT END  -->
<?php include_once(DIR_URL . "include/footer.php"); ?>