<?php
error_reporting( E_ALL );
require_once("./include/session.php");

if(isset($_POST['btn-signup'])) {
    $invite = $_POST['invite'];

    $invite['make'] = $id;
    $invite['token'] = generateRandomString(rand(40,60));
    $stmt2 = $auth_user->runQuery("INSERT INTO invite (make, email, token) VALUES(:make, :email, :token)");

    foreach($invite as $key => $val) {
        $stmt2->bindparam(":" . $key, $invite[$key]);
    }

    $stmt2->execute();

    include('./include/mail_send.php');
}

//thank https://stackoverflow.com/a/4356295
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$title = 'Member';
include("./include/header.php");
include("./include/nav-bar.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
            <p class="h2">Invitations a Member</p>
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


<form class="form-horizontal" method="post">
    <fieldset>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label"><b>Email</b></label>
            <div class="col-lg-10">
                <input type="email" required="required" class="form-control" name="invite[email]" placeholder="Email">
            </div>
        </div>

        <!--summit -->
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default" name="reset">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-danger" name="btn-signup">Invite</button>
            </div>
        </div>
    </fieldset>
</form>


    </div>
</div>

<?php include './include/footer.php' ?>
