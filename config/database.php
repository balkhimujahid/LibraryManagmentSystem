<?php
$conn = @new mysqli(SERVER_NAME, USERNAME, PASSWORD, DATABASE);

// check connection 
if ($conn->connect_error) {
    die("connection failed : " . $conn->connect_error);
}
