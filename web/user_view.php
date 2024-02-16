<?php
require_once("./include/session.php");

if(!isset($_GET['id'])) {
    $auth_user->redirect('user.php');
}

$stmt = $auth_user->runQuery("SELECT * FROM `user` WHERE id = :id");
$stmt->bindparam(":id", $_GET['id']);
$stmt->execute();
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if($member['id']!=$_GET['id']) {
    $auth_user->redirect('user.php');
}

$title = 'Member';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">User</p>
                <p class="h3"><?=$var['title'][$member['title']] . "  " . $member['firstname'] . "  " . $member['lastname']?></p>
                <object data="media/users/<?=$member['id']?>.png" type="image/png" width="256" height="256">
                    <span class="glyphicon glyphicon-user" style="font-size: 1800%;"></span>
                </object>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
                    <?php
                    if (have_permission('user_edit')) {
                    ?>
                    <a href="user_edit.php?id=<?=$_GET['id']?>" class="btn btn-success">
                        <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit Profile
                    </a>
                    <?php
                    }
                    if (have_permission('user_pic_upload')) {
                    ?>
                    <a href="user_pic_upload.php?id=<?=$_GET['id']?>" class="btn btn-success">
                        <span class="glyphicon glyphicon-picture"></span>&nbsp;Change picture
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
        <p class="h3">User information</p>

<!--<h3>Register TJ-SSF 2017</h3>-->
<form class="form-horizontal" method="post">
    <fieldset>
	<?php
	/*
        <!--email-->
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label"><b>Email</b></label>
            <div class="col-lg-10">
                <input disabled type="email" required="required" class="form-control" name="user[email]" placeholder="Email" value="<?=$member['email']?>">
            </div>
        </div>
	*/
    ?>
        <!--  title-->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Title</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="user[title]">
                    <?php
                    foreach($var['title'] as $key => $val) {
                    ?>
                    <option value="<?=$key?>"<?=$member['title']==$key?' selected="selected"':''?>><?=$val?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    
        <!-- firstname-->
        <div class="form-group">
            <label for="inputFirstName" class="col-lg-2 control-label"><b>Firstname</b></label>
            <div class="col-lg-10">
                <input disabled type="text" required="required" class="form-control" name="user[firstname]" placeholder="Firstname" value="<?=$member['firstname']?>">
            </div>
        </div>
   
        <!-- lastname-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Lastname</b></label>
            <div class="col-lg-10">
                <input disabled type="text" required="required" class="form-control" name="user[lastname]" placeholder="Lastname" value="<?=$member['lastname']?>">
            </div>
        </div>

        <!-- Nickname-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Nickname</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[nickname]" placeholder="Nickname" value="<?=$member['nickname']?>">
            </div>
        </div>

        <!--Gender-->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Gender</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="user[gender]">
                    <option value="0" <?=$member['gender']=='0'?'selected="selected"':''?>>Not specified</option>
                    <option value="1" <?=$member['gender']=='1'?'selected="selected"':''?>>Male</option>
                    <option value="2" <?=$member['gender']=='2'?'selected="selected"':''?>>Female</option>
                </select>
            </div>
        </div>
    
        <!-- Telephone-->
        <div class="form-group">
            <label for="inputTel" class="col-lg-2 control-label"><b>Tel.</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[tel]" placeholder="Telephone" value="<?=$member['tel']?>">
            </div>
        </div>

        <!-- Address1 -->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Address1</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[address1]" placeholder="Address1" value="<?=$member['address1']?>">
            </div>
        </div>

        <!-- Address2-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Address2</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[address2]" placeholder="Address2" value="<?=$member['address2']?>">
            </div>
        </div>

        <!-- City-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>City</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[city]" placeholder="City" value="<?=$member['city']?>">
            </div>
        </div>

        <!-- Province-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Province</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[province]" placeholder="Province" value="<?=$member['province']?>">
            </div>
        </div>

        <!-- Country-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Country</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="user[country]">
                    <?php
                    foreach($var['country'] as $key => $val) {
                    ?>
                    <option value="<?=$key?>"<?=$member['country']==$key?' selected="selected"':''?>><?=$val?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Zip-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Zip</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[zip]" placeholder="Zip" value="<?=$member['zip']?>">
            </div>
        </div>

        <!-- Chronic-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Chronic diseases</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[chronic]" placeholder="If any, please identify." value="<?=$member['chronic']?>">
            </div>
        </div>

        <!-- Allergies-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Allergies</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[allergies]" placeholder="If have please identify." value="<?=$member['allergies']?>">
            </div>
        </div>

        <!--Food restrictions-->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Food restrictions</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="user[food]">
                <?php
                foreach($var['food'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"<?=$member['food']==$key?' selected="selected"':''?>><?=$val?></option>
                <?php
                }
                ?>
                </select>
                <input disabled type="text" class="form-control" name="user[food_other]" id="food_other" placeholder="Pease identify." value="<?=$member['food_other']?>"<?=$member['food']!=99?' style="display: none;"':''?>>
            </div>
        </div>

        <!--Type-->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Type</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="user[type]">
                    <?php
                    foreach($var['m_type'] as $key => $val) {
                    ?>
                    <option value="<?=$key?>"<?=$member['type']==$key?' selected="selected"':''?>><?=$val?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <!--Occupation-->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Occupation</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" required="required" name="user[occupation]">
                    <?php
                    foreach($var['occupation'] as $key => $val) {
                    ?>
                    <option value="<?=$key?>"<?=$member['occupation']==$key?' selected="selected"':''?>><?=$val?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <!--Organization-->
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label"><b>Organization</b></label>
            <div class="col-lg-10">
                <select disabled class="form-control" name="user[organization]">
                    <option value="0">----</option>
                <?php
                $stmt = $auth_user->runQuery("SELECT id, name FROM `org`");
                $stmt->execute();
                while($org = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?=$org['id']?>"<?=$member['organization']==$org['id']?' selected="selected"':''?>><?=$org['name']?></option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>

        <!-- Position-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-2 control-label"><b>Blood type</b></label>
            <div class="col-lg-10">
                <input disabled type="text" class="form-control" name="user[position]" placeholder="Position" value="<?=$member['position']?>">
            </div>
        </div>
    </fieldset>
</form>
        </div>
    </div>
<?php include './include/footer.php' ?>