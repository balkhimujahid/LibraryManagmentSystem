<?php

include_once("../config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "include/middleware.php");
include_once(DIR_URL . "models/book.php");

// Add book functionality 
if (isset($_POST['publish'])) {
    $res = storeBook($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Book has been created successfully";
        header("LOCATION:" . BASE_URL . "books");
        exit;
    } else {
        $_SESSION['error'] = $res['error'];
        header("LOCATION:" . BASE_URL . "books/add.php");
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
        <div class="row deshboard-counts">
            <div class="col-md-12">
                <?php
                include_once(DIR_URL . "include/alerts.php");
                ?>
                <h4 class="fw-bold text-uppercase">Add Books</h4>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Fill the form
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo BASE_URL ?>books/add.php" onsubmit="return addbookForm()">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Book Title</label>
                                            <input type="text" name="title" class="form-control" id="exampleInputBookName" aria-describedby="emailHelp">
                                            <p class="error" id="bookNE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">ISBN
                                                Number</label>
                                            <input type="number" name="isbn" class="form-control" id="exampleInputIsbn">
                                            <p class="error" id="isbnE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Author Name</label>
                                            <input type="text" name="author" class="form-control" id="exampleInputAuthor" aria-describedby="emailHelp">
                                            <p class="error" id="authorE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Publisher
                                                Year</label>
                                            <input type="number" name="publication_year" class="form-control" id="exampleInputpublisher">
                                            <p class="error" id="publisherE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Category </label>
                                            <?php
                                            $cats = getCategories($conn);
                                            ?>
                                            <select class="form-control" name="category_id">
                                                <option value="">Please select</option>
                                                <?php while ($row = $cats->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button name="publish" class="btn btn-success">Publish</button>
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