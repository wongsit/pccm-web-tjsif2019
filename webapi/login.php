<?php
include 'dbcontroller.php';

// Get post date
if(!isset($_POST['email']) || !isset($_POST['password'])) {
    echo 'Can not get input data.';
    exit();
}

// Connect db
$mysqli = connect();
if (!$mysqli) {
    echo 'Failed to connect database.';
    exit();
}
// Get Hash
$sql = "SELECT password FROM tb_users WHERE email = ?";
$resultArray = array();
$hash ='';
if ($stmt = $mysqli->prepare($sql)) {
    $email = $_POST['email'];
    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();
    $resultArray = $result->fetch_assoc();

    if (empty($resultArray)) {
        echo 'Email or Password is not correct.';
        exit();
    }
    $hash = $resultArray['password'];
}

// Verify password
if (!password_verify($_POST['password'], $hash)) {
    echo 'Email or Password is not correct.';
    exit();
}
// Get user data
$sql = "SELECT id, firstname, middlename, lastname, occ_id, trip FROM tb_users WHERE email = ?";
$resultArray = array();
if ($stmt = $mysqli->prepare($sql)) {
    $email = $_POST['email'];
    $stmt->bind_param("s", $email);

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
    echo json_encode($resultArray);
}
