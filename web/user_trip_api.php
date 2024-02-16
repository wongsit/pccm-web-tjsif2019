<?php
require_once "./include/session.php";
require_once "./include/variable.php";

$auth_user = new USER();
$count = array();

//$id = $_GET['id'];

$count = countUserTrip();

if(isset($_POST['sel'])) {
    ///////////////////////
    //
    //   $id = $_GET['id'];
    //   $stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:id");
    //   $stmt->execute(array(":id"=>$id));
    //   $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //
    ///////////////////////
    if($user) {
        if($user['trip'] != $_POST['sel']) {
            if(isset($var['trip'][$_POST['sel']])) {
                if((isset($count[$_POST['sel']]) ? $count[$_POST['sel']] : 0) < $var['trip'][$_POST['sel']]['max']) {
                    $stmt2 = $auth_user->runQuery("UPDATE `user` SET `trip` = :trip WHERE `user`.`id` = :id");
                    $stmt2->bindparam(":trip", $_POST['sel']);
                    $stmt2->bindparam(":id", $id);
                    $stmt2->execute();
                    if($stmt2->rowCount()) {
                        $count = countUserTrip();
                        $data['res'] = 'ok';
                        $data['msg'] = 'Update successful';
                    } else {
                        $data['res'] = 'error';
                        $data['msg'] = 'Can\'n update.';
                    }
                } else {
                    $data['res'] = 'error';
                    $data['msg'] = 'This trip is full.';
                }
            } else {
                $data['res'] = 'error';
                $data['msg'] = 'Don\'t have this trip.';
            }
        } else {
            $data['res'] = 'ok';
            $data['msg'] = 'You are already in this trip.';
        }
    } else {
        $data['res'] = 'error';
        $data['msg'] = "Don't have this user.";
    }
}
$data['count'] = $count;

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
echo json_encode($data);

function countUserTrip(){
    global $auth_user;
    $stmt = $auth_user->runQuery("SELECT `trip`, COUNT(*) AS count FROM `user` GROUP BY `trip`");
    $stmt->execute();
    while($each_type = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $count[$each_type['trip']] = $each_type['count'];
    }
    return $count;
}