<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Invite</h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-12">
    <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
    </div>
    <?php
    //เช็คกับกำหนดการลงทะเบียน
    if($this->Site_model->check_register_date($this->System_model->get_date()) > 0){   //ถ้าไม่เกินกำหนด
    ?>
    <div class="col-sm-12">
      <?php echo form_open('members/member/send_email'); ?>
      <form>
          <div class="form-group">
              <label for="inputText"><?php echo $this->lang->line('login_user'); ?></label>
              <input type="email" name="email" class="form-control" required="required" autofocus="autofocus">
              <?php echo form_error('e_mail','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" value="login"><i class='fas fa-envelope'></i> Send Invite</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
            </button>
          </div>
      </form>
      <?php echo form_close(); ?>
    </div>
  <?php } ?>
  </div>
</div>
