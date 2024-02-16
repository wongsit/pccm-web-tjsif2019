<?php
require_once("./include/session.php");

$title = 'Member';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">Members list</p>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
<?php
if (have_permission('user_invite')) {
?>
                    <a href="user_invite.php" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Invite
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
        <div id="exTab1" class="container">	
            <ul  class="nav nav-pills">
<?php
$stmt = $auth_user->runQuery("SELECT * FROM `org` ORDER BY `org`.`name` ASC");
$stmt->execute();
$first = true;
$org_first = -1;
while ($org = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($first) {
        $org_first = $org['id'];
    }
?>
			    <li<?=$first?" class=\"active\"":""?>><a href="#org_<?=$org['id']?>" data-toggle="tab"><?=$org['name']?></a></li>
<?php
    $first = false;
}
?>
		    </ul>

			<div class="tab-content clearfix">
<?php
$stmt = $auth_user->runQuery("SELECT * FROM `user` ORDER BY `user`.`organization` ASC");
$stmt->execute();
$last_org = -1;
$user = $stmt->fetch(PDO::FETCH_ASSOC);
while($user) {
    if($user['organization'] != $last_org) {
?>
			    <div class="tab-pane<?=$org_first == $user['organization']?" active":""?>" id="org_<?=$user['organization']?>">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="128px">#</th>
                                    <th>Name</th>
                                    <th>Nickname</th>
                                    <th>Occupation</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    }
?>
                                <tr>
                                    <td>
                                        <object data="media/users/<?=$user['id']?>.png" type="image/png" width="128" height="128">
                                            <span class="glyphicon glyphicon-user" style="font-size: 900%;"></span>
                                        </object>
                                    </td>
                                    <td><a href="user_view.php?id=<?=$user['id']?>"><?=$var['title'][$user['title']] . "  " . $user['firstname'] . "  " . $user['lastname']?></a></td>
                                    <td><?=$user['nickname']?></td>
                                    <td><?=$var['occupation'][$user['occupation']]?></td>
                                    <td><?=$var['m_type'][$user['type']]?></td>
                                </tr>
<?php
    $last_org = $user['organization'];
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user['organization'] != $last_org) {
?>
                            </tbody>
                        </table>
                    </div>
                </div>
<?php
    }
}
?>
			</div>
        </div>
    </div>
</div>

<?php include './include/footer.php' ?>