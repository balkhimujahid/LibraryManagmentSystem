<?php


// function to get all books
function getCounts($conn)
{
    $counts = array(
        'total_books' => 0,
        'total_students' => 0,
        'total_loans' => 0,
        'total_revenue' => 0
    );

    ## get books counts
    $sql = "select count(id) as total_books from books";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $books = mysqli_fetch_assoc($res);
        $counts['total_books'] = $books['total_books'];
    }

    ## get students counts
    $sql = "select count(id) as total_students from students";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $books = mysqli_fetch_assoc($res);
        $counts['total_students'] = $books['total_students'];
    }

    ## get Loans counts
    $sql = "select count(id) as total_loans from book_loans";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $books = mysqli_fetch_assoc($res);
        $counts['total_loans'] = $books['total_loans'];
    }

    ## get Loans counts
    $sql = "select sum(amount) as total_revenue from subscriptions";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $books = mysqli_fetch_assoc($res);
        $counts['total_revenue'] = $books['total_revenue'];
    }

    return $counts;
}

// function to get Tab data
function getTabData($conn)
{
    $tabs = array(
        'students' => array(),
        'loans' => array(),
        'subscription' => array(),
    );

    ## get resent students
    $sql = "select * from students order by id desc limit 5";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tabs['students'][] = $row;
        }
    }

    ## get resent loans
    $sql = "select l.*, b.title as book_title, s.name as student_name
        from book_loans l
        inner join books b on b.id = l.book_id
        inner join students s on s.id = l.student_id
        order by l.id desc limit 5";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tabs['loans'][] = $row;
        }
    }

    ## get resent subscriptions
    $sql = "select s.*, sp.title as plan_title, st.name as student_name
        from subscriptions s
        inner join subscription_plans as sp on sp.id = s.plan_id
        inner join students as st on st.id = s.student_id
        order by s.id desc limit 5";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tabs['subscription'][] = $row;
        }
    }


    return $tabs;
}
