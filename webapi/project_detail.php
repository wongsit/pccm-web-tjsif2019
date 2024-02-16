<?php
include 'dbcontroller.php';

// connect db
$mysqli = connect();
if (!$mysqli) {
    echo 'Failed to connect database.';
    exit();
}
// get project data

$sql = "SELECT tb_project.id, tb_project.name, tb_project.concept, tb_project.objective, ";
$sql .= "tb_project_type.name AS category, tb_project_style.name AS style, tb_org.name AS org, ";
$sql .= "tb_project.students, tb_project.teachers, tb_project.files FROM tb_project ";
$sql .= "LEFT OUTER JOIN tb_project_type ON tb_project.category_id = tb_project_type.id ";
$sql .= "LEFT OUTER JOIN tb_project_style ON tb_project.style_id = tb_project_style.id ";
$sql .= "LEFT OUTER JOIN tb_org ON tb_project.org_id = tb_org.id ";
$sql .= "WHERE tb_project.id = ?";

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
        echo 'Project is not found.';
        exit();
    }
    echo json_encode($resultArray);
}
