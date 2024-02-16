<?php
require_once("./include/session.php");

if(!isset($_GET['id'])) {
    $auth_user->redirect('org.php');
}

if(isset($_POST['btn-signup'])) {
    $org = $_POST['org'];
    $query = 'UPDATE `org` SET ';
    foreach($org as $key => $val) {
        $query .= '`' . $key . '` = :' . $key . ', ';
    }
    $query = rtrim($query, ', ');
    $query .= ' WHERE `org`.`id` = :id';
    
    $stmt = $auth_user->runQuery($query);
    foreach($org as $key => $val) {
        $stmt->bindparam(":" . $key, $org[$key]);
    }
    $stmt->bindparam(":id", $_GET['id']);
    $stmt->execute();
}

$stmt = $auth_user->runQuery("SELECT * FROM `org` WHERE id = :id");
$stmt->bindparam(":id", $_GET['id']);
$stmt->execute();
$org = $stmt->fetch(PDO::FETCH_ASSOC);


$title = 'Organization';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">Edit organization</p>
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
        <p class="h3">Organization information</p>

<form class="form-horizontal" method="post">
    <fieldset>
        <!-- name-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Name</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[name]" placeholder="Name" value="<?=$org['name']?>">
            </div>
        </div>

        <!-- shortname-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Shortname</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[shortname]" placeholder="Shortname" value="<?=$org['shortname']?>">
            </div>
        </div>

        <!-- Address1 -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Address1</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[address1]" placeholder="Address1" value="<?=$org['address1']?>">
            </div>
        </div>

        <!-- Address2-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Address2</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[address2]" placeholder="Address2" value="<?=$org['address2']?>">
            </div>
        </div>

        <!-- City-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>City</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[city]" placeholder="City" value="<?=$org['city']?>">
            </div>
        </div>

        <!-- Province-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Province</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[province]" placeholder="Province" value="<?=$org['province']?>">
            </div>
        </div>

        <!-- Country-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Country</b></label>
            <div class="col-lg-10">
                <select class="form-control" name="org[country]">
                <?php
                foreach($var['country'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"<?=$org['country']==$key?' selected="selected"':''?>><?=$val?></option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>

        <!-- Zip-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Zip</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[zip]" placeholder="Zip" value="<?=$org['zip']?>">
            </div>
        </div>
        
        <!-- Telephone-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Tel.</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[tel]" placeholder="Telephone" value="<?=$org['tel']?>">
            </div>
        </div>

        <!-- Fax-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Fax</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[fax]" placeholder="Fax" value="<?=$org['fax']?>">
            </div>
        </div>

        <!--email-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Email</b></label>
            <div class="col-lg-10">
                <input type="email" required="required" class="form-control" name="org[email]" placeholder="Email" value="<?=$org['email']?>">
            </div>
        </div>

        <!-- homepage-->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Homepage</b></label>
            <div class="col-lg-10">
                <input type="text" class="form-control" name="org[homepage]" placeholder="Homepage" value="<?=$org['homepage']?>">
            </div>
        </div>

        <!--Type-->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Type</b></label>
            <div class="col-lg-10">
                <select class="form-control" name="org[type]">
                <?php
                foreach($var['o_type'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"<?=$org['type']==$key?' selected="selected"':''?>><?=$val?></option>
                <?php
                }
                ?>
                </select>
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
