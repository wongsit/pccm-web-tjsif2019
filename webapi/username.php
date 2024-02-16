<?php
include 'dbcontroller.php';

// Get post date
if(!isset($_POST['id'])) {
    echo 'Can not get post data.';
    exit();
}

// connect db
$mysqli = connect();
if (!$mysqli) {
    echo 'Failed to connect database.';
    exit();
}
// get user data
$sql = "SELECT firstname, middlename, lastname FROM tb_users WHERE id = ?";
$resultArray = array();
if ($stmt = $mysqli->prepare($sql)) {
    $id  = $_POST['id'];
    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();
    $resultArray = $result->fetch_assoc();

    $result->close();
    $stmt->close();
    $mysqli->close();

    if (empty($resultArray)) {
        echo 'Email or Password is not correct.';
        exit();
    }

    if (empty($resultArray['middlename'])) {
        echo $resultArray['firstname'] . ' ' . $resultArray['lastname'];
    } else {
        echo $resultArray['firstname'] . ' ' . $resultArray['middlename'] . ' ' . $resultArray['lastname'];
    }
}
