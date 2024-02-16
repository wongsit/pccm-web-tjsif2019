<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title.' | '.$this->lang->line('site_name'); ?></title>
    <!-- tjsif2019 Icon-->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icons/favicon.ico">
    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>/assets/css/sb-admin.css" rel="stylesheet">
  </head>
  <body class="bg-dark">
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header"><i class='fas fa-user-check' style='font-size:32px;'></i> <?php echo $this->lang->line('login_title'); ?></div>
        <div class="card-body">
          <?php if($error!='') { ?>
          <div class="alert alert-danger">
            <strong><?php echo $this->lang->line('warn'); ?></strong><br> <?php echo $error; ?>
          </div>
        <?php } ?>
          <?php echo form_open('users/account/login'); ?>
          <form>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="username" class="form-control" required="required" autofocus="autofocus">
                <label for="inputText"><?php echo $this->lang->line('login_user'); ?></label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="password" class="form-control">
                <label for="inputPassword"><?php echo $this->lang->line('login_pass'); ?></label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  <?php echo $this->lang->line('login_remember'); ?>
                </label>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary  btn-block" value="login"><?php echo $this->lang->line('login'); ?></button>
            </div>
          </form>
          <div class="text-center">
            <a class="d-block small" href="<?php echo base_url(); ?>users/account/forgot"><?php echo $this->lang->line('login_forgot'); ?></a>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  </body>
</html>
