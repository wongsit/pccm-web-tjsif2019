<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Profile - <?php echo $user->firstname.' '.$user->lastname; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-6">
          <h3>Don’t be a stranger</h3>
          <?php $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$user->id.'.jpg');
          if($img_check){ ?>
          <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $user->id.'.jpg'; ?>" class="rounded-circle img-responsive d-block w-100" alt="Cinque Terre">
        <?php }else{ ?>
          <i class='fas fa-user' style='font-size:240px;color:lightblue'></i>
        <?php  } ?>
        </div>
        <div class="col-sm-8">
          <?php
            //คำนวน prograss data โดยนับจำนวนข้อมูลที่กรอก / ข้อมูลที่ต้องกรอก *100
            $count_success = 0;
            if($user->firstname != '') $count_success +=1;
            if($user->middlename != '') $count_success +=1;
            if($user->lastname != '') $count_success +=1;
            if($user->nickname != '') $count_success +=1;
            if($user->title != '') $count_success +=1;
            if($user->gender != '') $count_success +=1;
            if($user->address1 != '') $count_success +=1;
            if($user->address2 != '') $count_success +=1;
            if($user->city != '') $count_success +=1;
            if($user->country != '') $count_success +=1;
            if($user->province != '') $count_success +=1;
            if($user->zip != '') $count_success +=1;
            if($user->tel != '') $count_success +=1;
            if($user->chronic != '') $count_success +=1;
            if($user->allergies != '') $count_success +=1;
            if($user->food != '') $count_success +=1;
            if($user->type != '') $count_success +=1;
            if($user->occ_id != '') $count_success +=1;
            if($user->org_id != '') $count_success +=1;
            if($user->about != '') $count_success +=1;
            $progress = $count_success / 20*100;
           ?>
          <label>Profile completeness</label>
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width:<?php echo round($progress,2); ?>%"><?php echo round($progress,2); ?>%</div>
          <br>
        </div>
      </div>
      <div class="col-sm-12">
        <?php echo 'Last '.$this->lang->line('update_time')." : ".$user->update_time;   //เวลา ?>
        <?php echo " ".$this->lang->line('update_ip')." : ".$user->update_ip;   //ไอพี ?>
        <?php echo " ".$this->lang->line('update_id')." : ".$user->update_name;   //ผู้ปรับปรุง ?>
      </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="row">
        <div class="col-sm-8">
        <button type="button" class="btn btn-outline-dark btn-lg btn-block" onclick="window.history.back();">
            <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
        </button>
        </div>
        <div class="col-sm-8">
          <a href="<?php echo base_url(); ?>members/member/index" class="btn btn-outline-dark  btn-lg  btn-block">View member list</a>
        </div>
        <div class="col-sm-8">
          <a href="#" class="btn btn-success btn-lg btn-block">View Attendance</a>
        </div>
      </div>
    </div>
    <hr class="featurette-divider">
    <div class="col-sm-10">
      <h3 class="taxt-muted">Personal information</h3>
      <div class="card">
        <div class="card-body">
          <?php echo form_open(''); ?>
            <form>
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputAbout"  class="control-label"><b>About me</b> (less than 255)</label>
                    <textarea class="form-control" name="about" id="about" rows="5" readonly><?php echo $user->about; ?></textarea>
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
                    <input type="text"  name="firstname"  class="form-control" value="<?php echo $user->firstname; ?>" required="required" readonly>
                    <?php echo form_error('firstname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('firstname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputMiddlename"><b>Middlename</b></label>
                    <input type="text" name="middlename" class="form-control"  value="<?php echo $user->middlename; ?>"
                    <?php if(form_error('middlename')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> readonly>
                    <?php echo form_error('middlename','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputLastName"><b>Lastname*</b></label>
                    <input type="text" name="lastname" class="form-control"  value="<?php echo $user->lastname; ?>"
                    <?php if(form_error('lastname')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> required="required" readonly>
                    <?php echo form_error('lastname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Nickname</b></label>
                    <input type="text" name="nickname" class="form-control"  value="<?php echo $user->nickname; ?>"
                    <?php if(form_error('nickname')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> readonly>
                    <?php echo form_error('nickname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputGender"><b>Gender*</b></label>
                    <select class="form-control" id="gender" name="gender" required="required" readonly>
                      <?php
                      foreach($genders as $gender) {
                        if($gender->id == $user->gender){ ?>
                          <option value="<?=$gender->id?>" selected><?=$gender->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title"><b>Title*</b></label>
                    <select class="form-control" id="title" name="title" required="required" readonly>
                      <?php
                      foreach($titles as $title) {
                        if($title->id == $user->title){ ?>
                          <option value="<?=$title->id?>" selected><?=$title->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address1</b></label>
                    <input type="text" name="address1" class="form-control"  value="<?php echo $user->address1; ?>"
                    <?php if(form_error('address1')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Address1" readonly>
                    <?php echo form_error('address1','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address2</b></label>
                    <input type="text" name="address2" class="form-control"  value="<?php echo $user->address2; ?>"
                    <?php if(form_error('address2')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="Address2" readonly>
                    <?php echo form_error('address2','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>City</b></label>
                    <input type="text" name="city" class="form-control"  value="<?php echo $user->city; ?>"
                    <?php if(form_error('city')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="city" readonly>
                    <?php echo form_error('city','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title"><b>Country*</b></label>
                    <select class="form-control" name="country" required="required" readonly>
                      <?php
                      foreach($countrys as $country) {
                        if($country->id == $user->country){ ?>
                          <option value="<?=$country->id?>" selected><?=$country->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Province</b></label>
                    <input type="text" name="province" class="form-control"  value="<?php echo $user->province; ?>"
                    <?php if(form_error('province')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Province" readonly>
                    <?php echo form_error('province','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Zip</b></label>
                    <input type="text" name="zip" class="form-control"  value="<?php echo $user->zip; ?>"
                    <?php if(form_error('zip')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Zip" readonly>
                    <?php echo form_error('zip','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Phone number</b></label>
                    <input type="text" name="tel" class="form-control"  value="<?php echo $user->tel; ?>"
                    <?php if(form_error('tel')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Telephone number" readonly>
                    <?php echo form_error('tel','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lastName"><b>Chronic diseases</b></label>
                    <input type="text" name="chronic" class="form-control"  value="<?php echo $user->chronic; ?>"
                    <?php if(form_error('chronic')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>placeholder="If any, please identify." readonly>
                    <?php echo form_error('chronic','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lastName"><b>Allergies</b></label>
                    <input type="text" name="allergies" class="form-control"  value="<?php echo $user->allergies; ?>"
                    <?php if(form_error('allergies')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="If have please identify." readonly>
                    <?php echo form_error('allergies','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Food restrictions*</b></label>
                    <select class="form-control" name="food" onchange="this.value==99?$('#food_other').show():$('#food_other').hide()" required="required" readonly>
                      <?php
                      foreach($foods as $food) {
                        if($food->id == $user->food){ ?>
                          <option value="<?=$food->id?>" selected><?=$food->name?></option>
                        <?php }
                      }?>
                    </select>
                    <input type="text" class="form-control" name="food_other" id="food_other" placeholder="Pease identify." style="display: none;" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastName" class="control-label"><b>Blood type</b></label>
                    <input type="text" name="position" class="form-control"  value="<?php echo $user->position; ?>"
                    <?php if(form_error('position')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Blood type" readonly>
                    <?php echo form_error('position','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Type*</b></label>
                    <select class="form-control" name="type" required="required" readonly>
                      <?php
                      foreach($types as $type) {
                        if($type->id == $user->type){ ?>
                          <option value="<?=$type->id?>" selected><?=$type->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Occupation*</b></label>
                    <select class="form-control" name="occ_id" required="required" readonly>
                      <?php
                      foreach($occ_types as $occ_type) {
                        if($occ_type->id == $user->occ_id){ ?>
                          <option value="<?=$occ_type->id?>" selected><?=$occ_type->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Organization*</b></label>
                    <select class="form-control" name="org_id" required="required" readonly>
                      <option value="">---Select---</option>
                      <?php
                      foreach($orgs as $org) {
                        if($org->id == $user->org_id){ ?>
                          <option value="<?=$org->id?>" selected><?=$org->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
              </form>
            <?php echo form_close(); ?>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="featurette-divider">
    <div class="col-sm-4">
    <button type="button" class="btn btn-outline-dark btn-lg btn-block" onclick="window.history.back();">
        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
    </button>
    </div>

  </div>
  </div>
  <hr class="featurette-divider">
</div>
