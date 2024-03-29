<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container col-sm-6">
    <div class="card">
      <div class="card-header"><i class='fas fa-user-check' style='font-size:32px;'></i> <b>Register for TJ-SSF 2019 by staff</b></div>
      <div class="card-body">
        <?php if(isset($error)) { ?>
          <div class="alert alert-danger">
            <strong><?php echo $this->lang->line('login_warn'); ?></strong> <?php echo $error; ?>
          </div>
        <?php } ?>
        <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
        <?php echo form_open('staff/member/add_member/'); ?>
        <?php if($this->session->flashdata('reg_result') == FALSE){ //?>
          <form>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEmail"  class="control-label"><b>Email*</b></label>
                  <input type="text" name="email" class="form-control" value="" placeholder="email"  required="required" autofocus="autofocus">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputPassword"><b>Password*</b>(more than 8 digit) default 12345678</label>
                  <input type="password" name="password" class="form-control" value="12345678" required="required"
                  <?php if(form_error('password')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>>
                  <?php echo form_error('password','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputConfirmPassword" class="control-label"><b>Confirm password*</b></label>
                  <input type="password" name="c_password" class="form-control" value="12345678" required="required"  autofocus="autofocus"
                  <?php if(form_error('c_password')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>>
                  <?php echo form_error('c_password','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputFirstName"  class="control-label"><b>Firstname*</b></label>
                  <input type="text"  name="firstname"  class="form-control" value="" required="required">
                  <?php echo form_error('firstname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  <?php echo form_error('firstname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputMiddlename"><b>Middlename</b></label>
                  <input type="text" name="middlename" class="form-control"  value=""
                  <?php if(form_error('middlename')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>>
                  <?php echo form_error('middlename','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputLastName"><b>Lastname*</b></label>
                  <input type="text" name="lastname" class="form-control"  value=""
                  <?php if(form_error('lastname')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> required="required">
                  <?php echo form_error('lastname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName"><b>Nickname</b></label>
                  <input type="text" name="nickname" class="form-control"  value=""
                  <?php if(form_error('nickname')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>>
                  <?php echo form_error('nickname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="inputGender"><b>Gender*</b></label>
                  <select class="form-control" id="gender" name="gender" required="required">
                    <option value="">---Select---</option>
                    <?php
                    foreach($genders as $gender) {
                      ?>
                      <option value="<?=$gender->id?>"><?=$gender->name?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title"><b>Title*</b></label>
                  <select class="form-control" id="title" name="title" required="required">
                    <option value="">---Select---</option>
                    <?php
                    foreach($titles as $title) {
                      ?>
                      <option value="<?=$title->id?>"><?=$title->name?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName"><b>Address1</b></label>
                  <input type="text" name="address1" class="form-control"  value=""
                  <?php if(form_error('address1')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Address1">
                  <?php echo form_error('address1','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName"><b>Address2</b></label>
                  <input type="text" name="address2" class="form-control"  value=""
                  <?php if(form_error('address2')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="Address2">
                  <?php echo form_error('address2','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName"><b>City</b></label>
                  <input type="text" name="city" class="form-control"  value=""
                  <?php if(form_error('city')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="city">
                  <?php echo form_error('city','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName"><b>Province</b></label>
                  <input type="text" name="province" class="form-control"  value=""
                  <?php if(form_error('province')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Province">
                  <?php echo form_error('province','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="title"><b>Country*</b></label>
                  <select class="form-control" name="country" required="required">
                    <option value="">---Select---</option>
                    <?php
                    foreach($countrys as $country) {
                      ?>
                      <option value="<?=$country->id?>"><?=$country->id?>-<?=$country->name?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName"><b>Zip</b></label>
                  <input type="text" name="zip" class="form-control"  value=""
                  <?php if(form_error('zip')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Zip">
                  <?php echo form_error('zip','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastName"><b>Phone number</b></label>
                  <input type="text" name="tel" class="form-control"  value=""
                  <?php if(form_error('tel')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Telephone number">
                  <?php echo form_error('tel','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="lastName"><b>Chronic diseases</b></label>
                  <input type="text" name="chronic" class="form-control"  value=""
                  <?php if(form_error('chronic')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>placeholder="If any, please identify.">
                  <?php echo form_error('chronic','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="lastName"><b>Allergies</b></label>
                  <input type="text" name="allergies" class="form-control"  value=""
                  <?php if(form_error('allergies')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="If have please identify.">
                  <?php echo form_error('allergies','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="select" class="control-label"><b>Food restrictions*</b></label>
                  <select class="form-control" name="food" onchange="this.value==99?$('#food_other').show():$('#food_other').hide()" required="required">
                    <option value="">---Select---</option>
                    <?php
                    foreach($foods as $food) {
                      ?>
                      <option value="<?=$food->id?>"><?=$food->name?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <input type="text" class="form-control" name="food_other" id="food_other" placeholder="Pease identify." style="display: none;">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName" class="control-label"><b>Blood type</b></label>
                  <input type="text" name="position" class="form-control"  value=""
                  <?php if(form_error('position')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Blood type">
                  <?php echo form_error('position','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="select" class="control-label"><b>Type*</b></label>
                  <select class="form-control" name="type" required="required">
                    <option value="">---Select---</option>
                    <?php
                    foreach($types as $type) {
                      ?>
                      <option value="<?=$type->id?>"><?=$type->name?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="select" class="control-label"><b>Occupation*</b></label>
                  <select class="form-control" name="occ_id" required="required">
                    <option value="">---Select---</option>
                    <?php
                    foreach($occ_types as $occ_type) {
                      ?>
                      <option value="<?=$occ_type->id?>"><?=$occ_type->name?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="select" class="control-label"><b>Organization*</b></label>
                  <select class="form-control" name="org_id" required="required">
                    <option value="">---Select---</option>
                    <?php
                    foreach($orgs as $org) {
                      ?>
                      <option value="<?=$org->id?>"><?=$org->name?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
                  <input type="hidden" name="update_time" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d H:i:s"); ?>">
                  <button type="submit" class="btn btn-success" value="login">SignUp</button>
                  <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                    <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                  </button>
                </div>
              </div>
            </form>
          <?php }else{ ?>
            <div class="form-group">
              <a class="btn btn-outline-success" role="button" href="<?php echo site_url('users/account/'); ?>"><?php echo $this->lang->line('login'); ?></a>
            </div>
          <?php } ?>
          <?php echo form_close(); ?>
          <div>
          </div>
        </div>
      </div>
    </div>
  </div>
