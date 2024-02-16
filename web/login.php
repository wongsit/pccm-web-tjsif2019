<?php
session_start();
require_once("./include/class.user.php");
$auth_user = new USER();

if($auth_user->is_loggedin()!="")
{
	$auth_user->redirect('homeuser.php');
}

if(isset($_POST['btn-login']))
{
//	$fname = strip_tags($_POST['txt_uname_email']);
	$email = strip_tags($_POST['txt_uname_email']);
	$password = strip_tags($_POST['txt_password']);

	if($auth_user->doLogin($email,$password))
	{
		$auth_user->redirect('homeuser.php');
	}
	else
	{
		$error = "Wrong Details !";
	}
}
$title = 'Log in';
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
			<div class="panel-heading">LOG IN</div>
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
        <label><b>Email</b></label>
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Enter Email" required />
        <span id="check-e"></span>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-12">
        <label><b>Password</b></label>
        <input type="password" class="form-control" name="txt_password" placeholder="Enter Password" required />
    </div>
</div>

<div class="form-group">
    <div class="col-lg-12">
            <button type="submit" name="btn-login" class="btn btn-success">
                	<i class="glyphicon glyphicon-log-in text-right"></i> &nbsp; Log In
            </button>
            <!--<br /><h5><input type="checkbox"> Remember me </h5>-->

          	<br />
    </div>
</div>
<div class="form-group">
    <div class="col-lg-12">
				 <a href="./forgot_password.php">Forgotten Password?</a>
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
