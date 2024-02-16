<?php
include 'dbcontroller.php';

// connect db
$mysqli = connect();
if (!$mysqli) {
    echo 'Failed to connect database.';
    exit();
}
// get project id
$sql = "SELECT project_name, room_id, present_time FROM tb_project_present ";
$sql .= "INNER JOIN tb_project ON tb_project_present.project_id = tb_project.id WHERE find_in_set(?,tb_project.students)";

$resultArray = array();
if ($stmt = $mysqli->prepare($sql)) {
    $id  = $_POST['id'];
    $stmt->bind_param("i", $id);

    $stmt->execute();

    $result = $stmt->get_result();
    $resultArray = $result->fetch_assoc();
    // while ($row = $result->fetch_assoc()) {
    //     $resultArray[] = $row;
    // }

    $result->close();
    $stmt->close();
    $mysqli->close();

    if (empty($resultArray)) {
        echo 'Presentation schedule is not found.';
        exit();
    }
    echo json_encode($resultArray);
}