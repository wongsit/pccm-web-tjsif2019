<?php
	require_once('./include/session.php');
	
	if($auth_user->is_loggedin()!="")
	{
		$auth_user->redirect('homeuser.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$auth_user->doLogout();
		$auth_user->redirect('index.php');
	}
