<?php

include_once("../config/config.php");
include_once(DIR_URL . "config/database.php");
include_once(DIR_URL . "include/middleware.php");
include_once(DIR_URL . "models/book.php");

// update book functionality 
if (isset($_POST['update'])) {
    $res = updateBook($conn, $_POST);
    if (isset($res['success'])) {
        $_SESSION['success'] = "Book has been updated successfully";
        header("LOCATION:" . BASE_URL . "books");
        exit;
    } else {
        $_SESSION['error'] = $res['error'];
        header("LOCATION:" . BASE_URL . "books/edit.php");
        exit;
    }
}

// Read get parameter to get book data
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $book = getBookById($conn, $_GET['id']);
    if ($book->num_rows > 0) {
        $book = mysqli_fetch_assoc($book);
    }
} else {
    header("LOACTION: " . BASE_URL . "books");
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
                <h4 class="fw-bold text-uppercase">Edit Books</h4>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Fill the form
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo BASE_URL ?>books/edit.php" onsubmit="return addbookForm()">
                                <input type="hidden" name="id" value="<?php echo $book['id'] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Book Title</label>
                                            <input type="text" name="title" class="form-control" id="exampleInputBookName" aria-describedby="emailHelp" value="<?php echo $book['title'] ?>" />
                                            <p class="error" id="bookNE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">ISBN
                                                Number</label>
                                            <input type="number" name="isbn" class="form-control" id="exampleInputIsbn" value="<?php echo $book['isbn'] ?>" />
                                            <p class="error" id="isbnE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Author Name</label>
                                            <input type="text" name="author" class="form-control" id="exampleInputAuthor" aria-describedby="emailHelp" value="<?php echo $book['author'] ?>" />
                                            <p class="error" id="authorE"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Publisher
                                                Year</label>
                                            <input type="number" name="publication_year" class="form-control" id="exampleInputpublisher" value="<?php echo $book['publication_year'] ?>" />
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
                                                <?php
                                                while ($row = $cats->fetch_assoc()) {
                                                    $selected = "";
                                                    if ($row['id'] === $book['category_id'])
                                                        $selected = "selected";
                                                ?>
                                                    <option <?php echo $selected ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button name="update" class="btn btn-success">Updated</button>
                                        <a href="<?php echo BASE_URL ?>books" class="btn btn-secondary">Back</a>
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