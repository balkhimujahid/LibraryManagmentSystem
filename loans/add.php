<?php

include_once("../config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "include/middleware.php");
include_once(DIR_URL . "models/loan.php");

// Add loan functionality 
if (isset($_POST['submit'])) {
    $res = create($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Book loan has been created successfully";
        header("LOCATION:" . BASE_URL . "loans");
        exit;
    } else {
        $_SESSION['error'] = $res['error']; //"Something went wrong, please try again" . $conn->error;
        header("LOCATION:" . BASE_URL . "loans/add.php");
        exit;
    }
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
                <h4 class="fw-bold text-uppercase">Add Loan</h4>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Fill the form
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo BASE_URL ?>loans/add.php" onsubmit="return addbookForm()">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Select Book</label>
                                            <?php
                                            $books = getBooks($conn);
                                            ?>
                                            <select class="form-control" name="book_id">
                                                <option value="">Please select</option>
                                                <?php while ($row = $books->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Select Student</label>
                                            <?php
                                            $students = getStudents($conn);
                                            ?>
                                            <select class="form-control" name="student_id">
                                                <option value="">Please select</option>
                                                <?php while ($row = $students->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Loan Date</label>
                                            <input type="date" class="form-control" id="exampleInputEmail1" name="loan_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Return/Due Date</label>
                                            <input type="date" class="form-control" id="exampleInputPassword1" name="return_date">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                                        <button type="reset" class="btn btn-secondary">Cencle</button>
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