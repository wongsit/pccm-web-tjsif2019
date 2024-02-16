<?php

$title = 'Home';
include("./include/header.php");
?>

<style>
table#rsmtb tr:nth-child(even) {
    background-color: #eee;
}
table#rsmtb tr:nth-child(odd) {
   background-color:#fff;
}
</style>

<div class="content-section-a">
    <div class="container">
        <div class="table-responsive">
            <table class="table" id="rsmtb">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Students</th>
                        <th>Teachers</th>
                        <th>Professor</th>
                        <th>Deputy</th>
                        <th>Director</th>
                        <th>JOVC/JICA</th>
                        <th>NP/JF</th>
                        <th>The other</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("./include/class.user.php");
                    $guest_user = new USER();
                    $stmt = $guest_user->runQuery("SELECT * FROM `org`");
                    $stmt->execute();
                    $count_total = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0,);
                    while($orgs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $count = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0,);
                      for ($i=1; $i < 10; $i++) {
                        if ($i == 8) {
                          $query = sprintf("SELECT COUNT(*) FROM `user` WHERE `occupation` = 99 AND `organization` = %d",$orgs['id']);
                          $tmp_count = $guest_user->runQuery($query);
                          $tmp_count->execute();
                          while($each_count = $tmp_count->fetch(PDO::FETCH_ASSOC)) {
                              $count[$i] = $each_count['COUNT(*)'];
                              $count_total[$i] += $count[$i];
                            }
                        } else if ($i == 9) {
                          $query = sprintf("SELECT COUNT(*) FROM `user` WHERE `organization` = %d",$orgs['id']);
                          $tmp_count = $guest_user->runQuery($query);
                          $tmp_count->execute();
                          while($each_count = $tmp_count->fetch(PDO::FETCH_ASSOC)) {
                              $count[$i] = $each_count['COUNT(*)'];
                              $count_total[$i] += $count[$i];
                            }
                        } else {
                          $query = sprintf("SELECT COUNT(*) FROM `user` WHERE `occupation` = %d AND `organization` = %d",$i,$orgs['id']);
                          $tmp_count = $guest_user->runQuery($query);
                          $tmp_count->execute();
                          while($each_count = $tmp_count->fetch(PDO::FETCH_ASSOC)) {
                              $count[$i] = $each_count['COUNT(*)'];
                              $count_total[$i] += $count[$i];
                            }
                          }
                      }
                    ?>
                    <tr>
                        <td><?=$orgs['name']?></td>
                        <td><?=$count[1]?></td>
                        <td><?=$count[2]?></td>
                        <td><?=$count[3]?></td>
                        <td><?=$count[4]?></td>
                        <td><?=$count[5]?></td>
                        <td><?=$count[6]?></td>
                        <td><?=$count[7]?></td>
                        <td><?=$count[8]?></td>
                        <td><?=$count[9]?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td>Total</td>
                        <td><?=$count_total[1]?></td>
                        <td><?=$count_total[2]?></td>
                        <td><?=$count_total[3]?></td>
                        <td><?=$count_total[4]?></td>
                        <td><?=$count_total[5]?></td>
                        <td><?=$count_total[6]?></td>
                        <td><?=$count_total[7]?></td>
                        <td><?=$count_total[8]?></td>
                        <td><?=$count_total[9]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './include/footer.php' ?>
