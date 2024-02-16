<?php
require_once("./include/session.php");

if(isset($_POST['btn-signup'])) {
    $project = $_POST['project'];
    $project['users'] = implode(",",$project['users']);
    
    $stmt = $auth_user->runQuery("INSERT INTO `project` (`id`, `name`, `concept`, `objective`, `category`, `style`, `organization`, `users`) VALUES (NULL, :name, :concept, :objective, :category, :style, :organization, :users);");
    foreach($project as $key => $val) {
        $stmt->bindparam(":" . $key, $project[$key]);
    }
    $stmt->execute();
    $id = $auth_user->lastInsertId();
    $auth_user->redirect('project_view.php?id=' . $id);
}

$title = 'Project';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">Add Project</p>
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
                <input type="text" class="form-control" name="project[name]" placeholder="Name">
            </div>
        </div>
    
        <!-- Concept -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Concept</b></label>
            <div class="col-lg-10">
                <textarea name="project[concept]" required="required" rows="15" class="form-control"></textarea>
            </div>
        </div>
    
        <!-- Objective -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Objective</b></label>
            <div class="col-lg-10">
                <textarea name="project[objective]" required="required" class="form-control"></textarea>
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
                    <option value="<?=$key?>"><?=$val?></option>
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
                    <option value="<?=$key?>"><?=$val?></option>
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
                    <option value="<?=$org['id']?>"><?=$org['name']?></option>
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
            while($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="checkbox">
                <label><input type="checkbox" name="project[users][]" value="<?=$user['id']?>"><?=$user['firstname'] . " " . $user['lastname']?></label>
            </div>
            <?php
            }
            ?>
        </div>

        <!--summit -->  
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default" name="reset">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-danger" name="btn-signup">SIGN UP</button>
            </div>
        </div>
    </fieldset>
</form>


</div>
</div>


<?php include './include/footer.php' ?>
