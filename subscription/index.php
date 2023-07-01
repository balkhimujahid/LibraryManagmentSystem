<?php

include_once("../config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "include/middleware.php");
include_once(DIR_URL . "models/subscription.php");

// Add-Edit functionality 
if (isset($_POST['submit'])) {

    //Create 
    if ($_POST['id'] == '') {
        $res = create($conn, $_POST);
        if (isset($res['success'])) {
            $_SESSION['success'] = "Plan has been created successfully";
            header("LOCATION: " . BASE_URL . "subscription");
            exit;
        } else {
            $_SESSION['error'] = $res['error'];
            header("LOCATION: " . BASE_URL . "subscription");
            exit;
        }
    } else { // Update
        $res = update($conn, $_POST);
        if (isset($res['success'])) {
            $_SESSION['success'] = "Plan has been updated successfully";
            header("LOCATION: " . BASE_URL . "subscription");
            exit;
        } else {
            $_SESSION['error'] = $res['error'];
            header("LOCATION: " . BASE_URL . "subscription");
            exit;
        }
    }
}

## Get Plans
$plans = getPlans($conn);
if (!isset($plans->num_rows)) {
    $_SESSION['error'] = "Error : " . $conn->error;
}

## Delete Plan
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $del = delete($conn, $_GET['id']);
    if ($del) {
        $_SESSION['success'] = "Plan has been deleted successfully";
    } else {
        $_SESSION['error'] = "Something went wrong";
    }
    header("LOCATION: " . BASE_URL . "subscription");
    exit;
}

##Get
if (isset($_GET['action']) && $_GET['action'] == 'status') {
    $update = updateStatus($conn, $_GET['id'], $_GET['status']);
    if ($update) {
        if ($_GET['status'] == 1)
            $msg = "Plan has been Active successfully";
        else $msg = "Plan has been Deactive successfully ";
        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong";
    }
    header("LOCATION: " . BASE_URL . "subscription");
    exit;
}


## Status update of Plans 
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id']) && $_GET['id'] > 0) {
    $plan = getPlanById($conn, $_GET['id']);
    if ($plan->num_rows > 0) {
        $plan = mysqli_fetch_assoc($plan);
    }
} else {
    $plan = array('title' => '', 'amount' => '', 'duration' => '', 'id' => '');
}

include_once(DIR_URL . "include/header.php");
include_once(DIR_URL . "include/topbar.php");
include_once(DIR_URL . "include/sidebar.php");

?>
<!-- MAIN CONTENT START  -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <!-- CARDS -->
        <div class="row deshboard-counts">
            <div class="col-md-12">
                <?php
                include_once(DIR_URL . "include/alerts.php");
                ?>
            </div>
            <h4 class="fw-bold text-uppercase">Subscription Plan</h4>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Plans
                    </div>
                    <div class="card-body">

                        <table id="example" class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="coll">#</th>
                                    <th scope="coll">Title</th>
                                    <th scope="coll">Amount</th>
                                    <th scope="coll">Duration</th>
                                    <th scope="coll">Status</th>
                                    <th scope="coll">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($plans->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $plans->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $i++ ?></th>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><i class="fa-solid fa-indian-rupee-sign me-1"></i><?php echo $row['amount'] ?></td>
                                            <td><?php echo $row['duration'] ?> months</td>
                                            <td><?php
                                                if ($row['status'] == 1)
                                                    echo '<span class="badge text-bg-success">Active</span>';
                                                else echo '<span class="badge text-bg-danger">Inactive</span>';
                                                ?></td>
                                            <td>
                                                <a href="<?php echo BASE_URL ?>subscription?action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary mx-2 btn-sm">Edit</a>
                                                <a onclick="return confirm('Are you Sure ?')" href="<?php echo BASE_URL ?>subscription?action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>

                                                <?php if ($row['status'] == 1) { ?>
                                                    <a href="<?php echo BASE_URL ?>subscription?action=status&id=<?php echo $row['id'] ?>&status=0" class="btn btn-warning btn-sm">Inactive</a>
                                                <?php }
                                                if ($row['status'] == 0) { ?>
                                                    <a href="<?php echo BASE_URL ?>subscription?action=status&id=<?php echo $row['id'] ?>&status=1" class="btn btn-success btn-sm">Active</a>

                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add New Plans
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo BASE_URL ?>subscription/index.php" onsubmit="return addplansForm()">
                            <input type="hidden" name="id" value="<?php echo $plan['id'] ?>">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" id="exampleInputtitle" name="title" value="<?php echo $plan['title'] ?>">
                                    <p class="error" id="titleE"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="exampleInputamount" name="amount" value="<?php echo $plan['amount'] ?>">
                                    <p class="error" id="amountE"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration</label>
                                    <select class="form-control" id="Duration" name="duration">
                                        <option value="">Please select</option>
                                        <?php
                                        for ($i = 1; $i < 13; $i++) {
                                            $selected = "";
                                            if ($i == $plan['duration'])
                                                $selected = "selected";
                                        ?>
                                            <option <?php echo $selected ?> value="<?php echo $i ?>"><?php echo $i ?> month(s)</option>
                                        <?php } ?>
                                    </select>
                                    <p class="error" id="durationE"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-success">Save</button>
                                <?php if ($plan['id'] == '') { ?>
                                    <button type="reset" class="btn btn-secondary">Cancle</button>
                                <?php } else { ?>
                                    <a href="<?php echo BASE_URL?>subscription" class="btn btn-secondary">Cancle</a>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- MAIN CONTENT END  -->

<?php include_once(DIR_URL . "include/footer.php"); ?>