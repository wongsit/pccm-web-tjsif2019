<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Organization infomation - <?php echo $org->name; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-6">
          <?php $img_check = file_exists('assets/images/orgs/tjsif2019-org-'.$org->id.'.jpg');
          if($img_check){ ?>
          <img src="<?php echo base_url(); ?>assets/images/orgs/tjsif2019-org-<?php echo $org->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
        <?php }else{ ?>
          <i class='fas fa-school' style='font-size:240px;color:lightblue'></i>
        <?php  } ?>
        </div>
        <div class="col-sm-8">
          <?php
            //คำนวน prograss data โดยนับจำนวนข้อมูลที่กรอก / ข้อมูลที่ต้องกรอก *100
            $count_success = 0;
            if($img_check) $count_success +=1;
            if($org->name != '') $count_success +=1;
            if($org->shortname != '') $count_success +=1;
            if($org->address1 != '') $count_success +=1;
            if($org->address2 != '') $count_success +=1;
            if($org->city != '') $count_success +=1;
            if($org->country != '') $count_success +=1;
            if($org->province != '') $count_success +=1;
            if($org->zip != '') $count_success +=1;
            if($org->tel != '') $count_success +=1;
            if($org->fax != '') $count_success +=1;
            if($org->email != '') $count_success +=1;
            if($org->homepage != '') $count_success +=1;
            if($org->type != '') $count_success +=1;
            if($org->about != '') $count_success +=1;
            $progress = $count_success / 15*100;
           ?>
          <label>Profile completeness</label>
        <div class="progress">
          <?php if($progress == 100){ ?>
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:<?php echo round($progress,2); ?>%"><?php echo  round($progress,2); ?>%</div>
          <?php }else{ ?>
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:<?php echo round($progress,2); ?>%"><?php echo  round($progress,2); ?>%</div>
          <?php }?>
          <br>
        </div>
      </div>
      <div class="col-sm-12">
        <?php echo 'Last '.$this->lang->line('update_time')." : ".$org->update_time;   //เวลา ?>
        <?php echo " ".$this->lang->line('update_ip')." : ".$org->update_ip;   //ไอพี ?>
        <?php echo " ".$this->lang->line('update_id')." : ".$org->update_name;   //ผู้ปรับปรุง ?>
      </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="row">
        <div class="col-sm-10">
        <button type="button" class="btn btn-outline-dark btn-lg btn-block" onclick="window.history.back();">
            <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
        </button>
        </div>
        <div class="col-sm-10">
          <a href="<?php echo base_url(); ?>staff/organization/index" class="btn btn-outline-success  btn-lg  btn-block">View organization list</a>
        </div>
        <div class="col-sm-10">
          <a href="<?php echo base_url(); ?>staff/organization/upload_picture/<?php echo $org->id; ?>" class="btn btn-warning btn-lg btn-block">Change picture</a>
        </div>
        <div class="col-sm-10">
          <a href="<?php echo base_url(); ?>staff/organization/edit/<?php echo $org->id; ?>" class="btn btn-primary btn-lg btn-block">Edit infomation</a>
        </div>
        <div class="col-sm-10">
          <?php if($this->session->userdata('username') == 'w.khanchai@pccm.ac.th'){ ?>
          <a href="<?php echo base_url(); ?>staff/organization/delete/<?php echo $org->id; ?>" class="btn btn-danger btn-lg btn-block">Delete this organization</a>
        <?php } ?>
        </div>
      </div>
    </div>
    <hr class="featurette-divider">
    <div class="col-sm-10">
      <h3 class="taxt-muted">Organization information</h3>
      <div class="card">
        <div class="card-body">
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong><?php echo $this->lang->line('login_warn'); ?></strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open(''); ?>
            <form>
              <div class="form-row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="inputSchoolName"  class="control-label"><b>School name*</b></label>
                    <input type="text"  name="name"  class="form-control" value="<?php echo $org->name; ?>" required="required" readonly>
                    <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputShortName"  class="control-label"><b>Shortname*</b></label>
                    <input type="text"  name="shortname"  class="form-control" value="<?php echo $org->shortname; ?>" required="required" readonly>
                    <?php echo form_error('shortname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('shortname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address1</b></label>
                    <input type="text" name="address1" class="form-control"  value="<?php echo $org->address1; ?>"
                    <?php if(form_error('address1')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Address1" readonly>
                    <?php echo form_error('address1','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address2</b></label>
                    <input type="text" name="address2" class="form-control"  value="<?php echo $org->address2; ?>"
                    <?php if(form_error('address2')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="Address2" readonly>
                    <?php echo form_error('address2','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>City</b></label>
                    <input type="text" name="city" class="form-control"  value="<?php echo $org->city; ?>"
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
                        if($country->id == $org->country){ ?>
                          <option value="<?=$country->id?>" selected><?=$country->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Province</b></label>
                    <input type="text" name="province" class="form-control"  value="<?php echo $org->province; ?>"
                    <?php if(form_error('province')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Province" readonly>
                    <?php echo form_error('province','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Zip</b></label>
                    <input type="text" name="zip" class="form-control"  value="<?php echo $org->zip; ?>"
                    <?php if(form_error('zip')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Zip" readonly>
                    <?php echo form_error('zip','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Phone number</b></label>
                    <input type="text" name="tel" class="form-control"  value="<?php echo $org->tel; ?>"
                    <?php if(form_error('tel')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Telephone number" readonly>
                    <?php echo form_error('tel','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Fax number</b></label>
                    <input type="text" name="fax" class="form-control"  value="<?php echo $org->fax; ?>"
                    <?php if(form_error('fax')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Telephone number" readonly>
                    <?php echo form_error('fax','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputEmail"  class="control-label"><b>Email*</b></label>
                    <input type="text" name="email" class="form-control" value="<?php echo $org->email; ?>" placeholder="email" readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputMiddlename"><b>Home page</b></label>
                    <input type="text" name="homepage" class="form-control"  value="<?php echo $org->homepage; ?>"
                    <?php if(form_error('homepage')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> readonly>
                    <?php echo form_error('homepage','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Organization Type</b></label>
                    <select class="form-control" name="type" required="required" readonly>
                      <option value="">---Select---</option>
                      <?php
                      foreach($org_types as $org_type) {
                        if($org_type->id == $org->type){ ?>
                          <option value="<?=$org_type->id?>" selected><?=$org_type->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputAbout"  class="control-label"><b>About school</b> (less than 255)</label>
                    <textarea class="form-control" name="about" id="about" rows="5" readonly><?php echo $org->about; ?></textarea>
                    <?php echo form_error('about','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('about','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
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
