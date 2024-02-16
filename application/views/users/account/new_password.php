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
        <div class="card-header"><i class='fas fa-user-check' style='font-size:32px;'></i> Setting new Your password.</div>
        <div class="card-body">
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong>Upload result => </strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open_multipart('users/account/do_change_password'); ?>
          <?php if($this->session->flashdata('reg_result') == FALSE){ //?>
            <form>
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputPassword"><b>New Password*</b>(more than 8 digit)</label>
                    <input type="password" name="password" class="form-control" required="required"  autofocus="autofocus"
                    <?php if(form_error('password')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Newt Password">
                    <?php echo form_error('password','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputConfirmPassword" class="control-label"><b>Confirm password*</b></label>
                    <input type="password" name="c_password" class="form-control" required="required"  autofocus="autofocus"
                    <?php if(form_error('c_password')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Confirm Password">
                    <?php echo form_error('c_password','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="login">Save Password</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="hidden" name="token" value="<?php echo $token ?>">
                <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
              </form>
            <?php }else{ ?>
              <div class="col-md-12">
              <div class="form-group">
                <a class="btn btn-outline-success" role="button" href="<?php echo site_url('users/account/'); ?>"><?php echo $this->lang->line('login'); ?></a>
              </div>
            </div>
            <?php } ?>
            <?php echo form_close(); ?>
          </div>
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
