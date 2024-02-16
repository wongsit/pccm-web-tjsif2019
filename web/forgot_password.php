<?php
session_start();
require_once("./include/class.user.php");

if(!class_exists('PHPMailer')) {
  require_once('./include/PHPMailerAutoload.php');
}

require_once("./include/mail_configuration.php");

$auth_user = new USER();

if($auth_user->is_loggedin()!="")
{
	$auth_user->redirect('homeuser.php');
}

if(isset($_POST['btn-submit']))
{
	$email = strip_tags($_POST['txt_uname_email']);
  if($email=="")	{
		$error = "Provide Email !";
	} else {
    $mail = new PHPMailer();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $emailBody = "<div>Hi,<br><br><p>Click this link to recover your password<br><a href='" . WEB_HOME . "reset_password.php?email=" . $email . "'>" . WEB_HOME . "reset_password.php?name=" . $email . "&cfx=". $randomString . "</a><br><br></p>Regards,<td style=\"height:5px;font-size:0;line-height:0\"></td> </div>".
    "<span class=\"HOEnZb\"><font color=\"#888888\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;border-top:1px solid #92959d\"><tbody><tr><td style=\"height:25px;font-size:0;line-height:0\"></td></tr><tr><td><div style=\"margin-left:2px;font-family:Arial,sans-serif;font-size:14px;line-height:23px;color:#83868f\">TJ-SSF 2018 Secretariat<br>Princess Chulabhorn Science High School Phitsanulok</div>".
    "</td></tr><tr><td style=\"height:24px;font-size:0;line-height:0\"></td></tr></tbody></table></font></span>";

    try {
      $mail->isSMTP();
      $mail->SMTPDebug = 0;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = "tls";
      $mail->Port     = PORT;
      $mail->Username = MAIL_USERNAME;
      $mail->Password = MAIL_PASSWORD;
      $mail->Host     = MAIL_HOST;

      $mail->setFrom(SERDER_EMAIL, SENDER_NAME);
      $mail->addReplyTo('tjssf2018@gmail.com', 'TJ-SSF 2018 SECRETARIAT');
      $mail->addAddress($email);
      $mail->Subject = "Forgot Password Recovery";
      $mail->Body = $emailBody;
      $mail->isHTML(true);

      if(!$mail->send()) {
      	$error = 'Problem in Sending Password Recovery Email';
      } else {
      	$error = 'Please check your email to reset password!';
      }
    } catch (Exception $e) {
    		error_log('Mailer Error: ' . $mail->ErrorInfo, 1, "noreply@pccpl.ac.th");
        print('Mailer Error: ' . $mail->ErrorInfo);
    }
  }
}
$title = 'Forgotten Password';
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
			<div class="panel-heading">Forgotten Password</div>
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
            <button type="submit" name="btn-submit" class="btn btn-success">Submit</button>
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
