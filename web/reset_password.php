<?php
session_start();
require_once("./include/class.user.php");
$auth_user = new USER();

if($auth_user->is_loggedin()!="")
{
	$auth_user->redirect('homeuser.php');
}

if(isset($_POST['btn-reset-password']))
{
	$password = strip_tags($_POST['txt_password']);
	$confirm_password = strip_tags($_POST['txt_confirm_password']);

	if($password==$confirm_password)
	{
		$auth_user->resetPassword($_GET["email"],$password);
		$auth_user->redirect('homeuser.php');
		$success_message = "Password is reset successfully.";
	} else if($password=="") {
		$error = "provide password !";
	} else if(strlen($user['password']) < 6) {
		$error = "Password must be atleast 6 characters";
	} else {
		$error = "Your password and confirmation password do not match.";
	}
}
$title = 'Reset Password';
?>

<?php include './include/header.php' ?>

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
                   <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Log in</a></li>
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
    <div class="col-lg-4"></div>
<div class="col-lg-4">
<div class="panel panel-info">
			<div class="panel-heading">Reset Password</div>
<div class="panel-body">

<form class="form-horizontal" method="post" id="login-form">
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>

<!--form-group-->
<div class="form-group">
    <div class="col-lg-12">
        <label><b>Password</b></label>
        <input type="password" class="form-control" name="txt_password" placeholder="Enter Password" required />
    </div>
</div>
<div class="form-group">
    <div class="col-lg-12">
        <label><b>Confirm Password</b></label>
        <input type="password" class="form-control" name="txt_confirm_password" placeholder="Enter Confirm Password" required />
    </div>
</div>

<div class="form-group">
    <div class="col-lg-12">
            <button type="submit" name="btn-reset-password" class="btn btn-success">Submit</button>
          	<br />
    </div>
</div>
</form>

   <hr>
        <p class="text-center">2018 © Thailand - Japan Student Science Fair 2018</p>
</div>
</div>

</div>
<div class="col-lg-4"></div>
</div>
</section>
</section>
</section>

<?php include './include/footer.php' ?>
