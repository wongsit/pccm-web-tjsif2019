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
        <div id="exTab1" class="container">
            <ul  class="nav nav-pills">
              <?php
              $stmt = $auth_user->runQuery("SELECT `category` FROM `project` GROUP BY `category` HAVING COUNT(*) > 0");
              $stmt->execute();
              $first = true;
              $cat_first = -1;
              while ($project = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  if ($first) {
                      $cat_first = $project['category'];
                  }
              ?>
              			    <li<?=$first?" class=\"active\"":""?>><a href="#cat_<?=$project['category']?>" data-toggle="tab"><?=$var['category'][$project['category']]?></a></li>
              <?php
                  $first = false;
              }
              ?>
            </ul>
            <div class="tab-content clearfix">
              <?php
              $stmt = $auth_user->runQuery("SELECT * FROM `project` ORDER BY `category` ASC, `organization` ASC");
              $stmt->execute();
              $cat_last = -1;
              $projects = $stmt->fetch(PDO::FETCH_ASSOC);
              while($projects) {
                if($projects['category'] != $cat_last) {
              ?>
                  <div class="tab-pane<?=$cat_first == $projects['category']?" active":""?>" id="cat_<?=$projects['category']?>">
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
                }
              ?>
                            <tr>
                                <td>
                                    <object data="media/projects/<?=$projects['id']?>.png" type="image/png" width="128" height="128">
                                        <span class="glyphicon glyphicon-book" style="font-size: 900%;"></span>
                                    </object>
                                </td>
                                <td><a href="project_view.php?id=<?=$projects['id']?>"><?=$projects['name']?></a></td>
                                <td><?=$var['category'][$projects['category']]?></td>
                                <td><?=$var['style'][$projects['style']]?></td>
                                <td><?=$orgs[$projects['organization']]['name']?></td>
                            </tr>
                            <?php
                            $cat_last = $projects['category'];
                            $projects = $stmt->fetch(PDO::FETCH_ASSOC);
                            if($projects['category'] != $cat_last) {
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
