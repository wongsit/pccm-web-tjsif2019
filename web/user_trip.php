<?php
require_once "./include/session.php";
require_once "./include/variable.php";

$count = countUserTrip();

if(isset($_POST['sel'])) {
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

                        $user['trip'] = $_POST['sel'];
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

function countUserTrip(){
    global $auth_user;
    $stmt = $auth_user->runQuery("SELECT `trip`, COUNT(*) AS count FROM `user` GROUP BY `trip`");
    $stmt->execute();
    while($each_type = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $count[$each_type['trip']] = $each_type['count'];
    }
    return $count;
}

$title = 'Member';
include "./include/header.php";
include "./include/nav-bar.php";
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">Field Trip</p>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
                    <a href="homeuser.php" class="btn btn-info">
                        <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                    </a>
                </div>
            </div>
        </div>
        
        <hr>

        <form method="post">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <?php
                    foreach($var['trip'] as $key => $val) {
                    ?>
                        <tr>
                            <td><?=$val['name']?></td>
                            <td><?=isset($count[$key]) ? $count[$key] : 0?>/<?=$val['max']?></td>
                            <td><?=$user['trip'] == $key ? "Selected" : ""?></td>
                            <td>
                                <button name="sel" type="submit" value="<?=$key?>" class="btn btn-success pull-right">select</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </form>

    </div>
</div>

<?php include './include/footer.php' ?>