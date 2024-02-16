<?php

require_once './include/class.user.php';

$auth_user = new USER();

$user = $_POST['user'];
$pass = $_POST['pass'];

$stmt = $auth_user->runQuery("SELECT * FROM user WHERE email = :email");
$stmt->execute(array(':email'=>$user));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
if ($stmt->rowCount() == 1) {
    $data['haveAcc'] = true;
	if (password_verify($pass, $userRow['password'])) {
        $data['pass'] = true;
    } else {
	    $data['pass'] = false;
	}
} else {
    $data['haveAcc'] = false;
    $data['pass'] = false;
}

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
echo json_encode($data);
