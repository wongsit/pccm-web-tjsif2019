<?php
require_once("./include/session.php");

if(!isset($_GET['id'])) {
    $auth_user->redirect('project_view.php');
}

if(isset($_POST['btn-signup'])) {
    $project = $_POST['project'];
    if(!empty($project['users'])) {
        $project['users'] = implode(",",$project['users']);
    } else {
        $project['users'] = '';
    }
    
    $query = 'UPDATE `project` SET ';
    foreach($project as $key => $val) {
        $query .= '`' . $key . '` = :' . $key . ', ';
    }
    $query = rtrim($query, ', ');
    $query .= ' WHERE `id` = :id';

    $stmt = $auth_user->runQuery($query);
    foreach($project as $key => $val) {
        $stmt->bindparam(":" . $key, $project[$key]);
    }
    $stmt->bindparam(":id", $_GET['id']);
    $stmt->execute();

    $auth_user->redirect('project_view.php?id=' . $_GET['id']);
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
                <p class="h2">Edit Project</p>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
                    <button type="button" class="btn btn-info" onclick="window.history.back();">
                        <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <p class="h3">Project information</p>

<form class="form-horizontal" method="post">
    <fieldset>
        <!-- name -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Name</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="project[name]" placeholder="Name" value="<?=$project['name']?>">
            </div>
        </div>
    
        <!-- Concept -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Concept</b></label>
            <div class="col-lg-10">
                <textarea name="project[concept]" required="required" rows="15" class="form-control"><?=$project['concept']?></textarea>
            </div>
        </div>
    
        <!-- Objective -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Objective</b></label>
            <div class="col-lg-10">
                <textarea name="project[objective]" required="required" class="form-control"><?=$project['objective']?></textarea>
            </div>
        </div>
            
        <!-- Category -->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Category</b></label>
            <div class="col-lg-10">
                <select class="form-control" name="project[category]">
                <?php
                foreach($var['category'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"<?=$project['category']==$key?' selected="selected"':''?>><?=$val?></option>
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
                <select class="form-control" name="project[style]">
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
                <select class="form-control" name="project[organization]">
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

        <div class="row">
            <?php
            $stmt = $auth_user->runQuery("SELECT * FROM `user`");
            $stmt->execute();

            $project['users'] = explode(",",$project['users']);

            while($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="checkbox">
                <label><input type="checkbox" name="project[users][]" value="<?=$user['id']?>" <?=in_array($user['id'], $project['users'])?'checked="checked"':''?>><?=$user['firstname'] . " " . $user['lastname']?></label>
            </div>
            <?php
            }
            ?>
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
