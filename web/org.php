<?php
require_once("./include/session.php");

$title = 'Organization';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
            <p class="h2">Organization list</p>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
                    <?php
                    if (have_permission('org_new')) {
                    ?>
                    <a href="org_new.php" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Organization
                    </a>
                    <?php
                    }
                    ?>
                    <a href="homeuser.php" class="btn btn-info">
                        <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <div class="table-responsive">          
            <table class="table">
                <thead>
                    <tr>
                        <th width="128px">#</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Country</th>
                        <th>Type</th>
                        <!--<th>Sister / Hosted by</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $auth_user->runQuery("SELECT * FROM `org`");
                    $stmt->execute();
                    while($org = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <object data="media/orgs/<?=$org['id']?>.png" type="image/png" width="128" height="128">
                                <span class="glyphicon glyphicon-briefcase" style="font-size: 900%;"></span>
                            </object>
                        </td>
                        <td><a href="org_view.php?id=<?=$org['id']?>"><?=$org['name']?></a></td>
                        <td><?=$org['city']?></td>
                        <td><?=$org['province']?></td>
                        <td><?=$org['country']?></td>
                        <td><?=$var['o_type'][$org['type']]?></td>
                        <!--<td><?=$org['sister']?></td>-->
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './include/footer.php' ?>
