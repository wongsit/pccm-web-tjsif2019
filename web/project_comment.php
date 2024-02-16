<?php
require_once("./include/session.php");

if(!isset($_GET['id'])) {
    $auth_user->redirect('project.php');
}

if(isset($_POST['btn-signup'])) {
    $comment = $_POST['comment'];

    $stmt = $auth_user->runQuery("INSERT INTO `comment` (`id`, `text`, `project`, `user`) VALUES (NULL, :text, :project, :user);");
    $stmt->bindparam(":text", $comment['text']);
    $stmt->bindparam(":project", $_GET['id']);
    $stmt->bindparam(":user", $_SESSION['user_session']);
    $stmt->execute();

    $comment_id = $auth_user->lastInsertId();

    $uploadOk = 1;

    if(isset($_FILES["fileToUpload"])) {
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
    
        if (!file_exists('uploads/projects')) {
            mkdir('uploads/projects', 0777, true);
        }
    
        if (!file_exists('uploads/projects/' . $_GET['id'])) {
            mkdir('uploads/projects/' . $_GET['id'], 0777, true);
        }
    
        $target_dir = "uploads/projects/" . $_GET['id'] . "/";
        $target_file = $target_dir . 'c' . $comment_id . '-' . $_FILES["fileToUpload"]["name"];
    
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500 * 1024 * 1024) { //500MB
            $error[] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error[] = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $uploadOk = 2;
            } else {
                $error[] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    //$auth_user->redirect('project_view.php?id=' . $_GET['id']);
}

$stmt = $auth_user->runQuery("SELECT * FROM `project` WHERE id = :id");
$stmt->bindparam(":id", $_GET['id']);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);


$title = 'Project';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">Project</p>
                <p class="h3"><?=$project['name']?></p>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
                    <?php
                    if (have_permission('project_edit')) {
                    ?>
                    <a href="project_edit.php?id=<?=$_GET['id']?>" class="btn btn-success">
                        <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit Project
                    </a>
                    <?php
                    }
                    ?>
                    <button type="button" class="btn btn-info" onclick="window.history.back();">
                        <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <p class="h3">Project information</p>

<form class="form-horizontal">
    <fieldset>
        <!-- name -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Name</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="project[name]" placeholder="Name" value="<?=$project['name']?>">
            </div>
        </div>

        <!-- Concept -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Concept</b></label>
            <div class="col-lg-10">
                <textarea disabled name="project[concept]" required="required" rows="15" class="form-control"><?=$project['concept']?></textarea>
            </div>
        </div>

        <!-- Objective -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Objective</b></label>
            <div class="col-lg-10">
                <textarea disabled name="project[objective]" required="required" class="form-control"><?=$project['objective']?></textarea>
            </div>
        </div>

        <!-- Category -->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Category</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="project[category]">
                    <?php
                    foreach($var['category'] as $key => $val) {
                    ?>
                    <option value="<?=$key?>" <?=$project['category']==$key?'selected="selected"':''?>><?=$val?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Style -->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Style</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="project[style]">
                    <?php
                    foreach($var['style'] as $key => $val) {
                    ?>
                    <option value="<?=$key?>" <?=$project['style']==$key?'selected="selected"':''?>><?=$val?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Organization -->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Organization</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="project[organization]">
                <?php
                $stmt = $auth_user->runQuery("SELECT id, name FROM `org`");
                $stmt->execute();
                while($org = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?=$org['id']?>" <?=$project['organization']==$org['id']?'selected="selected"':''?>><?=$org['name']?></option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>
    </fieldset>
</form>

<p class="h3">Member</p>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <tbody>
        <?php

        $project['users'] = explode(",",$project['users']);
        foreach ($project['users'] as $id) {
            $stmt = $auth_user->runQuery("SELECT * FROM user WHERE id=:id");
            $stmt->execute(array(":id"=>$id));

            $member = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
            <tr>
                <td><a href="user_view.php?id=<?=$id?>"><b><?=$var['title'][$user['title']] . " " . $member['firstname'] . "  " . $member['lastname']?></b></a></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<p class="h3">Documents</p>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
            <th>Document</th>
            <th>Last update</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php
            $file[] = "Abstract (.docx)";
            $file[] = "Abstract (.pdf)";
            $file[] = "Full paper(.docx)";
            $file[] = "Full Paper(.pdf)";

            $fileType = array('docx', 'pdf', 'docx', 'pdf');
            $target_dir = "uploads/projects/" . $_GET['id'] . "/";

            $fileExisCount = 0;
            for ($i = 0; $i <= 3; $i++) {
                $found = false;
                $update = "	Not updated yet";
                $target_file = $target_dir . $i . "." . $fileType[$i];
                if (file_exists($target_file)) {
                    $fileExisCount++;
                    $found = true;
                    $update = date ("F d", filemtime($target_file));
                }
            ?>
            <tr>
                <td><?=$file[$i]?></td>
                <td><?=$update?></td>
                <td>
                    <a href="project_download.php?id=<?=$_GET['id']?>&file=<?=$i?>" class="btn btn-success pull-right<?=$found==false?' disabled':''?>">
                        Download
                    </a>
                </td>
                <td>
                    <a href="project_comment_upload.php?id=<?=$_GET['id']?>&file=<?=$i?>" class="btn btn-primary<?=have_permission('project_comment')?'':' disabled'?>">
                        Upload file
                    </a>
                </td>
            </tr>
            <?php
            }
            ?>
            <tr>
            <td>
            <p class="h4">Number of file <?=$fileExisCount?></p>
            </td><td></td><td></td><td></td>
            </tr>
        </tbody>
    </table>


</div>

<p class="h3">Comment</p>
<div>
    <table class="table table-hover table-striped">
        <tbody>
        <?php
        $stmt = $auth_user->runQuery("SELECT `comment`.`id`, `comment`.`text`, `user`.`id` AS 'userid', `user`.`title`, `user`.`firstname`, `user`.`lastname` FROM `comment` INNER JOIN `user` ON `comment`.`user` = `user`.`id` WHERE `comment`.`project` = :id");
        $stmt->bindparam(":id", $_GET['id']);
        $stmt->execute();
        while($comment = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td>
                    <a href="user_view.php?id=<?=$comment['userid']?>"><b><?=$var['title'][$user['title']] . " " . $comment['firstname'] . "  " . $comment['lastname']?></b></a>
                    <br>
                    <?=nl2br($comment['text'])?>
                    <?php
                    foreach (glob("uploads/projects/" . $_GET['id'] . "/c" . $comment['id'] . "-*") as $filename) {
                    ?>
                    <br>
                    <b>Attachments : </b><a href="<?=$filename?>"><?=pathinfo($filename, PATHINFO_BASENAME)?></a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <fieldset>
        <!-- Concept -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Add new comment</b></label>
            <div class="col-lg-10">
                <textarea name="comment[text]" required="required" rows="15" class="form-control"></textarea>
            </div>
        </div>

        <!-- name -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Attachments</b></label>
            <div class="col-lg-10">
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
            </div>
        </div>

        <!--summit -->
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default" name="reset">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-danger" name="btn-signup">Save</button>
            </div>
        </div>
    </fieldset>
</form>

    </div>
</div>


<?php include './include/footer.php' ?>
