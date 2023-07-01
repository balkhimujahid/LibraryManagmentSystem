<?php

include_once("../config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "include/middleware.php");
include_once(DIR_URL . "models/book.php");

## Get Books
$books = getBooks($conn);
if (!isset($books->num_rows)) {
    $_SESSION['error'] = "Error : " . $conn->error;
}

## Delete Books
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $del = deleteBook($conn, $_GET['id']);
    if ($del) {
        $_SESSION['success'] = "Book has been deleted successfully";
    } else {
        $_SESSION['error'] = "Something went wrong";
    }
    header("LOCATION: " . BASE_URL . "books");
    exit;
}

## Status update of books Books
if (isset($_GET['action']) && $_GET['action'] == 'status') {
    $update = updateBookStatus($conn, $_GET['id'], $_GET['status']);
    if ($update) {
        if ($_GET['status'] == 1)
            $msg = "Book has been successfully activated";
        else $msg = "Book has been successfully deactivated";
        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong";
    }
    header("LOCATION: " . BASE_URL . "books");
    exit;
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
                <h4 class="fw-bold text-uppercase">Manage Books</h4>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Books
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-responsive table-striped style=" width:100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="coll">#</th>
                                            <th scope="coll">Book Name</th>
                                            <th scope="coll">Publication_year</th>
                                            <th scope="coll">Author Name</th>
                                            <th scope="coll">ISBN No</th>
                                            <th scope="coll">Category Name</th>
                                            <th scope="coll">Status</th>
                                            <th scope="coll">Created At</th>
                                            <th scope="coll">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($books->num_rows > 0) {
                                            $i = 1;
                                            while ($row = $books->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i++ ?></th>
                                                    <td><?php echo $row['title'] ?></td>
                                                    <td><?php echo $row['publication_year'] ?></td>
                                                    <td><?php echo $row['author'] ?></td>
                                                    <td><?php echo $row['isbn'] ?></td>
                                                    <td><?php echo $row['categories_name'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['status'] == 1)
                                                            echo '<span class="badge text-bg-success">Active</span>';
                                                        else echo '<span class="badge text-bg-danger">Inactive</span>';
                                                        ?>
                                                    </td>
                                                    <td><?php echo date("d-m-y h:i:A", strtotime($row['created_at'])) ?></td>
                                                    <td><a href="<?php echo BASE_URL ?>books/edit.php?id=<?php echo $row['id'] ?>" class="btn btn-primary mx-2 btn-sm">Edit</a>
                                                        <a onclick="return confirm('Are your Sure ?')" href="<?php echo BASE_URL ?>books?action=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                                        <?php if ($row['status'] == 1) { ?>
                                                            <a href="<?php echo BASE_URL ?>books?action=status&id=<?php echo $row['id'] ?>&status=0" class="btn btn-warning btn-sm">Inactive</a>
                                                        <?php }
                                                        if ($row['status'] == 0) { ?>
                                                            <a href="<?php echo BASE_URL ?>books?action=status&id=<?php echo $row['id'] ?>&status=1" class="btn btn-success btn-sm">Active</a>
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- MAIN CONTENT END  -->

<?php include_once(DIR_URL . "include/footer.php"); ?>