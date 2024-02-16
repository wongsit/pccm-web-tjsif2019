<?php
include 'dbcontroller.php';

// connect db
$mysqli = connect();
if (!$mysqli) {
    echo 'Failed to connect database.';
    exit();
}
// get project data
$sql = "SELECT tb_project.id, tb_project.name, tb_project_type.name AS category, ";
$sql .= "tb_project_style.name AS style, tb_org.name AS org, tb_project.id AS picture ";
$sql .= "FROM tb_project LEFT OUTER JOIN tb_project_type ON tb_project.category_id = tb_project_type.id ";
$sql .= "LEFT OUTER JOIN tb_project_style ON tb_project.style_id = tb_project_style.id ";
$sql .= "LEFT OUTER JOIN tb_org ON tb_project.org_id = tb_org.id ORDER BY tb_project.name";

$resultArray = array();
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $resultArray[] = $row;
    }

    $result->close();
    $stmt->close();
    $mysqli->close();

    if (empty($resultArray)) {
        echo 'Project is not registered.';
        exit();
    }
    echo json_encode($resultArray);
}
