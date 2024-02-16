<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Create Project</h1>
  <hr class="featurette-divider">
  <div class="row">

    <hr class="featurette-divider">
    <div class="col-sm-10">
      <h3 class="taxt-muted">Project information</h3>
      <div class="card">
        <div class="card-body">
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong><?php echo $this->lang->line('login_warn'); ?></strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open('members/project/add'); ?>
          <form>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputName"  class="control-label"><b>Project name*</b></label>
                  <input type="text"  name="name"  class="form-control" value="" required="required">
                  <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputConcept"  class="control-label"><b>Concept*</b></label>
                  <textarea class="form-control" name="concept" id="about" rows="10" required="required"></textarea>
                  <?php echo form_error('concept','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  <?php echo form_error('concept','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputObjective"  class="control-label"><b>Objective*</b> (less than 255)</label>
                  <textarea class="form-control" name="objective" id="objective" rows="3" required="required"></textarea>
                  <?php echo form_error('objective','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  <?php echo form_error('objective','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title"><b>category*</b></label>
                  <select class="form-control" name="category_id" required="required">
                    <option value="">-Choose catagory of project-</option>
                    <?php
                    foreach($categorys as $category) { ?>
                      <option value="<?=$category->id?>"><?=$category->name?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title"><b>Style</b></label>
                  <select class="form-control" name="style_id" required="required" readonly>
                    <option value="1"><?php echo $this->Project_model->fetch_project_style_name(1) ?></option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="select" class="control-label"><b>Organization</b></label>
                  <select class="form-control" name="org_id" required="required" readonly>
                    <option value="<?php echo $this->session->userdata('org_id'); ?>">
                      <?php echo $this->Org_model->fetch_org_name($this->session->userdata('org_id')); ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <h3 class="text-primary"><b>Students</b></h3>
                  <?php foreach($users as $user) { ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check">
                          <?php if($user->occ_id == 1){ // 1: Students ดูค่าในตาราง tb_occ_type ?>
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="students[]" value="<?php echo $user->id; ?>"> <?php echo $user->firstname.' '.$user->lastname; ?>
                            </label>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="col-md-6">
                  <h3 class="text-primary"><b>Teachers</b></h3>
                  <?php foreach($users as $user) { ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check">
                          <?php if($user->occ_id == 2){ // 2: Teacher ดูค่าในตาราง tb_occ_type ?>
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="teachers[]" value="<?php echo $user->id; ?>"> <?php echo $user->firstname.' '.$user->lastname; ?>
                            </label>
                          <?php } ?>

                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block" value="add">Create</button>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <button type="button" class="btn btn-secondary btn-block" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
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

    </div>
  </div>
