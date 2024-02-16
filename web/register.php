<?php
session_start();
require_once('./include/class.user.php');
$auth_user = new USER();

if(!isset($_GET['token'])||$_GET['token']=="") {
    header("Location: index.php");
}

$stmt = $auth_user->runQuery("SELECT id, token, email FROM invite WHERE token=:token && used!=1");
$stmt->execute(array(':token'=>$_GET['token']));
$invitekey=$stmt->fetch(PDO::FETCH_ASSOC);

if($invitekey['token']==$_GET['token']||isset($_GET['joined'])) {

} else {
    header("Location: index.php");
}

if($auth_user->is_loggedin()!="") {
	$auth_user->redirect('homeuser.php');
}

if(isset($_POST['btn-signup'])) {
    $user = $_POST['user'];

	if($user['firstname']=="")	{
		$error[] = "provide Firstname !";
	} else if($user['email']=="")	{
		$error[] = "provide Email !";
	} else if(!filter_var($user['email'], FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
    } else if($user['password']=="")	{
		$error[] = "provide password !";
	} else if(strlen($user['password']) < 6) {
		$error[] = "Password must be atleast 6 characters";
	} else {
		try {
			$stmt = $auth_user->runQuery("SELECT email FROM user WHERE email=:email");
			$stmt->execute(array(':email'=>$user['email']));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['email']==$user['email']) {
				$error[] = "sorry email already taken !";
			} else {
				if($auth_user->register($user)){
                    $stmt = $auth_user->runQuery("UPDATE `invite` SET `used` = '1' WHERE `invite`.`id` = :id;");
                    $stmt->execute(array(':id'=>$invitekey['id']));

					$auth_user->redirect('register.php?joined');
				}
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
    }
}

$title = 'Register';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>
	<section id="container">
		<!--header start-->

		<nav class="navbar navbar-inverse navbar-fixed-top topnav" role="navigation">
            <div class="container topnav">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand topnav" href="index.php">TJSSF-2018</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Login</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

		<!--header end-->

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <div class="row">
	                <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="panel panel-info">
			                <div class="panel-heading">TJ-SSF 2018 Register</div>

                            <div class="panel-body">
	                            <div class="col-lg-12">
<!--<h3>Register TJ-SSF 2017</h3>-->
<form class="form-horizontal" method="post">
    <fieldset>
        <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
        ?>
        <div class="alert alert-danger">
            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
        </div>
        <?php
				}
			}
			else if(isset($_GET['joined']))
			{
        ?>
        <div class="alert alert-dismissible alert-success">
            <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>Login</a> here
        </div>
        <?php
			}
        ?>
        <!--email-->
        <div class="form-group">
            <label for="inputEmail" class="col-lg-3 control-label"><b>Email*</b></label>
            <div class="col-lg-9">
                <input type="email" required="required" class="form-control" name="user[email]" placeholder="Email" value="<?=$invitekey['email']?>">
            </div>
        </div>

        <!--password-->
        <div class="form-group">
            <label for="inputPassword" class="col-lg-3 control-label"><b>Password*</b></label>
            <div class="col-lg-9">
                <input type="password" required="required" class="form-control" name="user[password]" placeholder="Password" pattern=".{6,}" title="6 letters minimum">
            </div>
        </div>

        <!--  title-->
        <div class="form-group">
            <label for="select" class="col-lg-3 control-label"><b>Title</b></label>
            <div class="col-lg-9">
                <select class="form-control" name="user[title]">
                <?php
                foreach($var['title'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"><?=$val?></option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>

        <!-- firstname-->
        <div class="form-group">
            <label for="inputFirstName" class="col-lg-3 control-label"><b>Firstname*</b></label>
            <div class="col-lg-9">
                <input type="text" required="required" class="form-control" name="user[firstname]" placeholder="Firstname">
            </div>
        </div>

        <!-- lastname-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Lastname*</b></label>
            <div class="col-lg-9">
                <input type="text" required="required" class="form-control" name="user[lastname]" placeholder="Lastname">
            </div>
        </div>

        <!-- Nickname-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Nickname</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[nickname]" placeholder="Nickname">
            </div>
        </div>

        <!--Gender-->
        <div class="form-group">
            <label for="select" class="col-lg-3 control-label"><b>Gender</b></label>
            <div class="col-lg-9">
                <select class="form-control" name="user[gender]">
                    <option value="0">Not specified</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
        </div>

        <!-- Telephone-->
        <div class="form-group">
            <label for="inputTel" class="col-lg-3 control-label"><b>Tel.</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[tel]" placeholder="Telephone">
            </div>
        </div>

        <!-- Address1 -->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Address1</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[address1]" placeholder="Address1">
            </div>
        </div>

        <!-- Address2-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Address2</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[address2]" placeholder="Address2">
            </div>
        </div>

        <!-- City-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>City</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[city]" placeholder="City">
            </div>
        </div>

        <!-- Province-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Province</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[province]" placeholder="Province">
            </div>
        </div>

        <!-- Country-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Country</b></label>
            <div class="col-lg-9">
                <select class="form-control" name="user[country]">
                <?php
                foreach($var['country'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"><?=$val?></option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>

        <!-- Zip-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Zip</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[zip]" placeholder="Zip">
            </div>
        </div>

        <!-- Chronic-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Chronic diseases</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[chronic]" placeholder="If any, please identify.">
            </div>
        </div>

        <!-- Allergies-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Allergies</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[allergies]" placeholder="If have please identify.">
            </div>
        </div>

        <!--Food restrictions-->
        <div class="form-group">
            <label for="select" class="col-lg-3 control-label"><b>Food restrictions</b></label>
            <div class="col-lg-9">
                <select class="form-control" name="user[food]" onchange="this.value==99?$('#food_other').show():$('#food_other').hide()">
                <?php
                foreach($var['food'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"><?=$val?></option>
                <?php
                }
                ?>
                </select>
                <input type="text" class="form-control" name="user[food_other]" id="food_other" placeholder="Pease identify." style="display: none;">
            </div>
        </div>

        <!--Type-->
        <div class="form-group">
            <label for="select" class="col-lg-3 control-label"><b>Type</b></label>
            <div class="col-lg-9">
                <select class="form-control" name="user[type]">
                <?php
                foreach($var['m_type'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"><?=$val?></option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>

        <!--Occupation-->
        <div class="form-group">
            <label for="select" class="col-lg-3 control-label"><b>Occupation*</b></label>
            <div class="col-lg-9">
                <select class="form-control" required="required" name="user[occupation]">
                <?php
                foreach($var['occupation'] as $key => $val) {
                ?>
                    <option value="<?=$key?>"><?=$val?></option>
                <?php
                }
                ?>
                </select>
            </div>
        </div>

        <!--Organization-->
        <div class="form-group">
            <label for="select" class="col-lg-3 control-label"><b>Organization</b></label>
            <div class="col-lg-9">
                <select class="form-control" name="user[organization]">
                    <option value="0">Register first, choose here.</option>
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

        <!-- Blood type-->
        <div class="form-group">
            <label for="inputLastName" class="col-lg-3 control-label"><b>Blood type</b></label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="user[position]" placeholder="Blood type">
            </div>
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
                            </div> <!--class="panel-body"-->
                        </div>
                    </div> <!--class="col-lg-6"-->
                    <div class="col-lg-3"></div>
                </div> <!--class="row"-->

                <!--class="wrapper site-min-height"-->
            </section> <!--id="main-content"-->
        </section>
    </section> <!--id="container"-->


<?php include './include/footer.php' ?>
