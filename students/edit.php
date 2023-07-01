<?php

include_once("../config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "include/middleware.php");
include_once(DIR_URL . "models/student.php");

// update student functionality 
if (isset($_POST['submit'])) {
    $res = update($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Student has been updated successfully";
        header("LOCATION:" . BASE_URL . "students");
        exit;
    } else {
        $_SESSION['error'] = $res['error'];
        header("LOCATION:" . BASE_URL . "students/edit.php");
        exit;
    }
}

// Read get parameter to get student data
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $student = getStudentById($conn, $_GET['id']);
    if ($student->num_rows > 0) {
        $student = mysqli_fetch_assoc($student);
    }
} else {
    header("LOACTION: " . BASE_URL . "students");
}

?>
<?php

include_once(DIR_URL . "include/header.php");
include_once(DIR_URL . "include/sidebar.php");
include_once(DIR_URL . "include/topbar.php");

?>
<!-- MAIN CONTENT START  -->
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <!-- CARDS -->
        <div class="row">
            <div class="col-md-12">
                <?php
                include_once(DIR_URL . "include/alerts.php");
                ?>
                <h4 class="fw-bold text-uppercase">Edit Students</h4>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Fill the form
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo BASE_URL ?>students/edit.php" onsubmit="return addbookForm()">
                                <input type="hidden" name="id" value="<?php echo $student['id'] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="exampleInputfullname" name="name" value="<?php echo $student['name'] ?>">
                                            <p class="error" id="nameE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="<?php echo $student['email'] ?>">
                                            <p class="error" id="emailE"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Phone No</label>
                                            <input type="number" class="form-control" id="exampleInputphoneno" name="phone_no" value="<?php echo $student['phone_no'] ?>">
                                            <p class="error" id="phoneE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" id="exampleInputaddress" value="<?php echo $student['address'] ?>">
                                            <p class="error" id="addressE"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                                        <a href="<?php echo BASE_URL ?>students" class="btn btn-secondary">Cancle</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- MAIN CONTENT END  -->

<?php include_once(DIR_URL . "include/footer.php"); ?>