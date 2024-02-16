<?php
require_once("./include/session.php");

if(!isset($_GET['id'])||!isset($_GET['file'])) {
    $auth_user->redirect('project.php');
}

if(0 > $_GET['file'] || $_GET['file'] > 3){
    $auth_user->redirect('project_view.php?id=' . $_GET['id']);
}

$stmt = $auth_user->runQuery("SELECT * FROM `project` WHERE id = :id");
$stmt->bindparam(":id", $_GET['id']);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);

$file[] = "Abstract";
$file[] = "Abstract";
$file[] = "Full paper";
$file[] = "Full Paper";

$fileType = array('docx', 'pdf', 'docx', 'pdf');
$target_dir = "uploads/projects/" . $_GET['id'] . "/";
$target_file = $target_dir . $_GET['file'] . "." . $fileType[$_GET['file']];
if (file_exists($target_file)) {
    $download = $project['name'] . " (" . $file[$_GET['file']] . ")." . $fileType[$_GET['file']];
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($download).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($target_file));
    readfile($target_file);
    exit;
} else {
    $auth_user->redirect('project_view.php?id=' . $_GET['id']);
}