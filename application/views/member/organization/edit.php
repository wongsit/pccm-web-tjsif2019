<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Edit Organization - <?php echo $org->name; ?></h1>
  <hr class="featurette-divider">
  <div class="row">

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
          <?php echo form_open('members/organization/update'); ?>
            <form>
              <div class="form-row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="inputSchoolName"  class="control-label"><b>School name*</b></label>
                    <input type="text"  name="name"  class="form-control" value="<?php echo $org->name; ?>" required="required" >
                    <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputShortName"  class="control-label"><b>Shortname*</b></label>
                    <input type="text"  name="shortname"  class="form-control" value="<?php echo $org->shortname; ?>" required="required" >
                    <?php echo form_error('shortname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('shortname','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address1</b></label>
                    <input type="text" name="address1" class="form-control"  value="<?php echo $org->address1; ?>"
                    <?php if(form_error('address1')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Address1" >
                    <?php echo form_error('address1','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Address2</b></label>
                    <input type="text" name="address2" class="form-control"  value="<?php echo $org->address2; ?>"
                    <?php if(form_error('address2')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="Address2" >
                    <?php echo form_error('address2','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>City</b></label>
                    <input type="text" name="city" class="form-control"  value="<?php echo $org->city; ?>"
                    <?php if(form_error('city')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>   placeholder="city" >
                    <?php echo form_error('city','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="title"><b>Country*</b></label>
                    <select class="form-control" name="country" required="required" >
                      <?php
                      foreach($countrys as $country) {
                        if($country->id == $org->country){ ?>
                          <option value="<?=$country->id?>" selected><?=$country->id?> - <?=$country->name?></option>
                        <?php }else { ?>
                          <option value="<?=$country->id?>"><?=$country->name?></option>
                      <?php }
                    }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Province</b></label>
                    <input type="text" name="province" class="form-control"  value="<?php echo $org->province; ?>"
                    <?php if(form_error('province')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Province" >
                    <?php echo form_error('province','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Zip</b></label>
                    <input type="text" name="zip" class="form-control"  value="<?php echo $org->zip; ?>"
                    <?php if(form_error('zip')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> placeholder="Zip" >
                    <?php echo form_error('zip','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Phone number</b></label>
                    <input type="text" name="tel" class="form-control"  value="<?php echo $org->tel; ?>"
                    <?php if(form_error('tel')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Telephone number" >
                    <?php echo form_error('tel','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="lastName"><b>Fax number</b></label>
                    <input type="text" name="fax" class="form-control"  value="<?php echo $org->fax; ?>"
                    <?php if(form_error('fax')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?>  placeholder="Telephone number" >
                    <?php echo form_error('fax','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputEmail"  class="control-label"><b>Email*</b></label>
                    <input type="text" name="email" class="form-control" value="<?php echo $org->email; ?>" placeholder="email" >
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="inputMiddlename"><b>Home page</b></label>
                    <input type="text" name="homepage" class="form-control"  value="<?php echo $org->homepage; ?>"
                    <?php if(form_error('homepage')!=null){ echo "autofocus"; } //โฟกัสอัตโนมัติ ?> >
                    <?php echo form_error('homepage','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select" class="control-label"><b>Organization Type</b></label>
                    <select class="form-control" name="type" required="required" >
                      <option value="">---Select---</option>
                      <?php
                      foreach($org_types as $org_type) {
                        if($org_type->id == $org->type){ ?>
                          <option value="<?=$org_type->id?>" selected><?=$org_type->name?></option>
                        <?php }else{ ?>
                          <option value="<?=$org_type->id?>"><?=$org_type->name?></option>
                        <?php }
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="inputAbout"  class="control-label"><b>About school</b> (less than 255)</label>
                    <textarea class="form-control" name="about" id="about" rows="5" ><?php echo $org->about; ?></textarea>
                    <?php echo form_error('about','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                    <?php echo form_error('about','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  </div>
                </div>
                <div class="col-md-12">
                  <label class="control-label"><b>Sister</b></label>
              </div>
                <?php $div = explode(",",$org->sister); //แยก id sister school ออกมา แช่น 2,5,12 => 2 5 12 ?>
                <?php foreach($orgs as $org) { ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="sister[]" value="<?php echo $org->id; ?>"
                          <?php for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
                            if($org->id == $div[$i]) echo 'checked';
                          } ?> > <?php echo $org->name; ?>
                      </label>
                    </div>
                  </div>
                </div>
              <?php } ?>
                <div class="col-md-8">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" value="edit">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $this->session->userdata('org_id'); ?>">
                <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
                <input type="hidden" name="update_time" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d H:i:s"); ?>">
                <input type="hidden" name="update_name" value="<?php echo $this->session->userdata('firstname'); ?>">
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
