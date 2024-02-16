<?php
require_once "./include/session.php";
require_once "./include/variable.php";

$count = countUserSciwalk();

if(isset($_POST['sel'])) {
    if($user) {
        if($user['sciwalk'] != $_POST['sel']) {
            if(isset($var['sciwalk'][$_POST['sel']])) {
                if((isset($count[$_POST['sel']]) ? $count[$_POST['sel']] : 0) < 60) {
                    $stmt2 = $auth_user->runQuery("UPDATE `user` SET `sciwalk` = :sciwalk WHERE `user`.`id` = :id");
                    $stmt2->bindparam(":sciwalk", $_POST['sel']);
                    $stmt2->bindparam(":id", $id);
                    $stmt2->execute();
                    if($stmt2->rowCount()) {
                        $count = countUserSciwalk();
                        $data['res'] = 'ok';
                        $data['msg'] = 'Update successful';

                        $user['sciwalk'] = $_POST['sel'];
                    } else {
                        $data['res'] = 'error';
                        $data['msg'] = 'Can\'n update.';
                    }
                } else {
                    $data['res'] = 'error';
                    $data['msg'] = 'This package of science walk rally is full.';
                }
            } else {
                $data['res'] = 'error';
                $data['msg'] = 'Don\'t have this package of science walk rally.';
            }
        } else {
            $data['res'] = 'ok';
            $data['msg'] = 'You are already in this package of science walk rally.';
        }
    } else {
        $data['res'] = 'error';
        $data['msg'] = "Don't have this user.";
    }
}

function countUserSciwalk(){
    global $auth_user;
    $stmt = $auth_user->runQuery("SELECT `sciwalk`, COUNT(*) AS count FROM `user` GROUP BY `sciwalk`");
    $stmt->execute();
    while($each_type = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $count[$each_type['sciwalk']] = $each_type['count'];
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
                <p class="h2">Science Walk Rally</p>
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
                    <thead>
                      <tr>
                        <th>Package</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($var['sciwalk'] as $key => $val) {
                    ?>
                        <tr>
                            <td><?=$val?></td>
                            <td><?=isset($count[$key]) ? $count[$key] : 0?>/60</td>
                            <td><?=$user['sciwalk'] == $key ? "Selected" : ""?></td>
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
