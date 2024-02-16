<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Edit Profile - <?php echo $user->firstname.' '.$user->lastname; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <hr class="featurette-divider">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-body">
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong><?php echo $this->lang->line('login_warn'); ?></strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open('staff/profile/update'); ?>
          <?php if($this->session->flashdata('reg_result') == FALSE){ //?>
            <form>
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputAbout"  class="control-label"><b>About me</b> (less than 255)</label>
                    <textarea class="form-control" name="about" id="about" rows="5" ><?php echo $user->about; ?></textarea>
                    <?php echo form_error('about','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('about','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputEmail"  class="control-label"><b>Email*</b></label>
                    <input type="text" name="email" class="form-control" value="<?php echo $user->email; ?>" placeholder="email" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputFirstName"  class="control-label"><b>Firstname*</b></label>
                    <input type="text"  name="firstname"  class="form-control" value="<?php echo $user->firstname; ?>" required="required" >
                    <?php echo form_error('firstname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('firstname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputMiddlename"><b>Middlename</b></label>
                    <input type="text" name="middlename" class="form-control"  value="<?php echo $user->middlename; ?>"
                    <?php if(form_error('middlename')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> >
                    <?php echo form_error('middlename','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputLastName"><b>Lastname*</b></label>
                    <input type="text" name="lastname" class="form-control"  value="<?php echo $user->lastname; ?>"
                    <?php if(form_error('lastname')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> required="required" >
                    <?php echo form_error('lastname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Nickname</b></label>
                    <input type="text" name="nickname" class="form-control"  value="<?php echo $user->nickname; ?>"
                    <?php if(form_error('nickname')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> >
                    <?php echo form_error('nickname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputGender"><b>Gender*</b></label>
                    <select class="form-control" id="gender" name="gender" required="required" >
                      <?php
                      foreach($genders as $gender) {
                        ?>
                        <?php
                        if($gender->id == $user->gender){ ?>
                          <option value="<?=$gender->id?>" selected><?=$gender->name?></option>
                        <?php }else{ ?>
                          <option value="<?=$gender->id?>"><?=$gender->name?></option>
                        <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title"><b>Title*</b></label>
                    <select class="form-control" id="title" name="title" required="required" >
                      <option value="">---Select---</option>
                      <?php
                      foreach($titles as $title) {
                        ?>
                        <?php
                        if($title->id == $user->title){ ?>
                          <option value="<?=$title->id?>" selected><?=$title->name?></option>
                        <?php } else{ ?>
                          <option value="<?=$title->id?>"><?=$title->name?></option>
                        <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address1</b></label>
                    <input type="text" name="address1" class="form-control"  value="<?php echo $user->address1; ?>"
                    <?php if(form_error('address1')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Address1" >
                    <?php echo form_error('address1','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address2</b></label>
                    <input type="text" name="address2" class="form-control"  value="<?php echo $user->address2; ?>"
                    <?php if(form_error('address2')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="Address2" >
                    <?php echo form_error('address2','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>City</b></label>
                    <input type="text" name="city" class="form-control"  value="<?php echo $user->city; ?>"
                    <?php if(form_error('city')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="city" >
                    <?php echo form_error('city','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title"><b>Country*</b></label>
                    <select class="form-control" name="country" required="required" >
                      <option value="">---Select---</option>
                      <?php
                      foreach($countrys as $country) {
                        ?>
                        <?php
                        if($country->id == $user->country){ ?>
                          <option value="<?=$country->id?>" selected><?=$country->id?>-<?=$country->name?></option>
                        <?php }else{ ?>
                          <option value="<?=$country->id?>"><?=$country->id?>-<?=$country->name?></option>
                        <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Province</b></label>
                    <input type="text" name="province" class="form-control"  value="<?php echo $user->province; ?>"
                    <?php if(form_error('province')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Province" >
                    <?php echo form_error('province','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Zip</b></label>
                    <input type="text" name="zip" class="form-control"  value="<?php echo $user->zip; ?>"
                    <?php if(form_error('zip')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Zip" >
                    <?php echo form_error('zip','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Phone number</b></label>
                    <input type="text" name="tel" class="form-control"  value="<?php echo $user->tel; ?>"
                    <?php if(form_error('tel')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Telephone number" >
                    <?php echo form_error('tel','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lastName"><b>Chronic diseases</b></label>
                    <input type="text" name="chronic" class="form-control"  value="<?php echo $user->chronic; ?>"
                    <?php if(form_error('chronic')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>placeholder="If any, please identify." >
                    <?php echo form_error('chronic','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lastName"><b>Allergies</b></label>
                    <input type="text" name="allergies" class="form-control"  value="<?php echo $user->allergies; ?>"
                    <?php if(form_error('allergies')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="If have please identify." >
                    <?php echo form_error('allergies','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Food restrictions*</b></label>
                    <select class="form-control" name="food" onchange="this.value==99?$('#food_other').show():$('#food_other').hide()" required="required" >
                      <option value="">---Select---</option>
                      <?php
                      foreach($foods as $food) {
                        ?>
                        <?php
                        if($food->id == $user->food){ ?>
                          <option value="<?=$food->id?>" selected><?=$food->name?></option>
                        <?php }else{ ?>
                          <option value="<?=$food->id?>"><?=$food->name?></option>
                        <?php }
                      }
                      ?>
                    </select>
                    <input type="text" class="form-control" name="food_other" id="food_other" placeholder="Pease identify." style="display: none;" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastName" class="control-label"><b>Blood type</b></label>
                    <input type="text" name="position" class="form-control"  value="<?php echo $user->position; ?>"
                    <?php if(form_error('position')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Blood type" >
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
                        <?php
                        if($type->id == $user->type){ ?>
                          <option value="<?=$type->id?>" selected><?=$type->name?></option>
                        <?php }else{ ?>
                          <option value="<?=$type->id?>"><?=$type->name?></option>
                        <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Occupation*</b></label>
                    <select class="form-control" name="occ_id" required="required" >
                      <option value="">---Select---</option>
                      <?php
                      foreach($occ_types as $occ_type) {
                        ?>
                        <?php
                        if($occ_type->id == $user->occ_id){ ?>
                          <option value="<?=$occ_type->id?>" selected><?=$occ_type->name?></option>
                        <?php }else{ ?>
                          <option value="<?=$occ_type->id?>"><?=$occ_type->name?></option>
                        <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Organization*</b></label>
                    <select class="form-control" name="org_id" required="required">
                      <option value="">---Select---</option>
                      <?php
                      foreach($orgs as $org) {
                        ?>
                        <?php
                        if($org->id == $user->org_id){ ?>
                          <option value="<?=$org->id?>" selected><?=$org->name?></option>
                        <?php }else{ ?>
                          <option value="<?=$org->id?>"><?=$org->name?></option>
                        <?php  }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="login">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $user->id ?>">
                <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
                <input type="hidden" name="update_time" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d H:i:s"); ?>">
                <input type="hidden" name="update_name" value="<?php echo $this->session->userdata('firstname'); ?>">
              </form>
            <?php }else{ ?>
              //
            <?php } ?>
            <?php echo form_close(); ?>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="featurette-divider">

  </div>
</div>
<hr class="featurette-divider">
</div>
