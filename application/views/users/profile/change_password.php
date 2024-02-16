<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Change Password - <?php echo $user->firstname.' '.$user->lastname; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <hr class="featurette-divider">
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong>Upload result => </strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open_multipart('users/profile/do_change_password'); ?>
          <?php if($this->session->flashdata('reg_result') == FALSE){ //?>
            <form>
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputPassword"><b>Current Password*</b></label>
                    <input type="password" name="o_password" class="form-control" required="required"  autofocus="autofocus"
                    <?php if(form_error('o_password')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Current Password">
                    <?php echo form_error('o_password','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
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
                    <button type="submit" class="btn btn-primary" value="login">Change</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $this->session->userdata('id') ?>">
                <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
                <input type="hidden" name="update_name" value="<?php echo $this->session->userdata('firstname'); ?>">
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
    <hr class="featurette-divider">

  </div>
  </div>
  <hr class="featurette-divider">
</div>
