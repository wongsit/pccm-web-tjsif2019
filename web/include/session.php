<?php
session_start();
require_once 'class.user.php';
$auth_user = new USER();

if(!$auth_user->is_loggedin())
{
	$auth_user->redirect('login.php');
}
	
$id = $_SESSION['user_session'];
	
$stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:id");
$stmt->execute(array(":id"=>$id));
	
$user = $stmt->fetch(PDO::FETCH_ASSOC);


$permission['org_edit']['occupation'] = array(2, 3, 4, 5, 6, 7, 99);
$permission['org_edit']['own'] = true;
$permission['org_pic_upload']['occupation'] = array(2, 3, 4, 5, 6, 7, 99);
$permission['org_pic_upload']['own'] = true;
$permission['org_new']['type'] = array(2, 3, 4 , 5);

$permission['project_comment']['occupation'] = array(3);
$permission['project_edit']['occupation'] = array(1, 2, 3);
$permission['project_edit']['own'] = true;
$permission['project_new']['occupation'] = array(1, 2, 3);
$permission['project_pic_upload']['occupation'] = array(1, 2, 3);
$permission['project_pic_upload']['own'] = true;
$permission['project_upload']['occupation'] = array(1, 2, 3);
$permission['project_upload']['own'] = true;

$permission['user_invite']['occupation'] = array(2, 3);
$permission['user_edit']['own'] = true;
$permission['user_pic_upload']['own'] = true;
$permission['user_trip']['occupation'] = array(1);


if (!have_permission()) {
	$redirect = strtok(basename($_SERVER['SCRIPT_FILENAME'], '.php'),"_");
	if(isset($_GET['id'])) {
		$redirect .= "_view.php?id=" . $_GET['id'];
	} else {
		$redirect .= ".php";
	}
	$auth_user->redirect($redirect);
}

function have_permission($script = NULL, $id = NULL) {
	global $permission, $user, $auth_user;
	if (empty($script)) {
		$script = basename($_SERVER['SCRIPT_FILENAME'], '.php');
	}

	if (empty($id) && isset($_GET['id'])) {
		$id = $_GET['id'];
	}

	if (isset($permission[$script]['own'])){
		switch (strtok(basename($_SERVER['SCRIPT_FILENAME'], '.php'),"_")) {
			case 'user':
				if ($user['id'] != $id) {
					return false;
				}
				break;
			case 'project':
				$stmt = $auth_user->runQuery("SELECT `users` FROM `project` WHERE id = :id");
				$stmt->bindparam(":id", $id);
				$stmt->execute();
				$project = $stmt->fetch(PDO::FETCH_ASSOC);
				$project['users'] = explode(",",$project['users']);
				if (!in_array($user['id'], $project['users'])) {
					return false;
				}
				break;
			case 'org':
				if ($user['organization'] != $id) {
					return false;
				}
				break;
		}
	}

	if (isset($permission[$script]['type'])){
		if (!in_array($user['type'], $permission[$script]['type'])) {
			return false;
		}
	}
	
	if (isset($permission[$script]['occupation'])){
		if (!in_array($user['occupation'], $permission[$script]['occupation'])) {
			return false;
		}
	}

	return true;
}