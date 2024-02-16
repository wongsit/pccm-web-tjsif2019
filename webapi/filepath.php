<?php
include 'dbcontroller.php';

// Get post date
if(!isset($_POST['project_id'])) {
    echo 'Can not get post data.';
    exit();
}

// connect db
$mysqli = connect();
if (!$mysqli) {
    echo 'Failed to connect database.';
    exit();
}
// get project data
$sql = "SELECT name from tb_files WHERE project_id = ?";

$resultArray = array();
if ($stmt = $mysqli->prepare($sql)) {
    $id  = $_POST['project_id'];
    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $resultArray[] = $row;
    }

    $result->close();
    $stmt->close();
    $mysqli->close();

    if (empty($resultArray)) {
        echo 'File is not registered.';
        exit();
    }
    echo json_encode($resultArray);
}
