<?php
require_once("./include/session.php");

$title = 'Project';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");

$stmt = $auth_user->runQuery("SELECT * FROM `org`");
$stmt->execute();
while($each_org = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $orgs[$each_org['id']] = $each_org;
}
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">Project list</p>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
                    <?php
                    if (have_permission('project_new')) {
                    ?>
                    <a href="project_new.php" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Project
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
                        <th>Category</th>
                        <th>Style</th>
                        <th>Organization</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $auth_user->runQuery("SELECT * FROM `project`");
                    $stmt->execute();
                    while($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <object data="media/projects/<?=$project['id']?>.png" type="image/png" width="128" height="128">
                                <span class="glyphicon glyphicon-book" style="font-size: 900%;"></span>
                            </object>
                        </td>
                        <td><a href="project_view.php?id=<?=$project['id']?>"><?=$project['name']?></a></td>
                        <td><?=$var['category'][$project['category']]?></td>
                        <td><?=$var['style'][$project['style']]?></td>
                        <td><?=$orgs[$project['organization']]['name']?></td>
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
