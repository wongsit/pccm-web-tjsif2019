<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted"><?php echo $title; ?></h1>
  <hr class="featurette-divider">
  <div class="row">

    <hr class="featurette-divider">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-body">
          <div class="jumbotron">
            <h1><b><?php echo $title; ?></b></h1>
            <h3>A questionnaire to realize the <b>special needs</b> in organizing the project presentation’s location</h3>
          </div>
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong><?php echo $this->lang->line('login_warn'); ?></strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open('members/project/add_required'); ?>
          <form>
            <div class="form-row">
              <div class="col-md-8">
                <h5 class="text-muted"><b>Footnote:</b></h5>
                 <p> The space for setting the project is 90 cm. x 140 cm. </p>
                 <p> There is one table for placing the presenting equipment, the size of table is 90 cm. x 60 cm. </p>
               <hr class="featurette-divider">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="form-check">
                        <h5 class="text-muted"><b>Your project needs</b> (Tick correct if you need)</h5>
                        <label class="form-check-label">
                          <p> <input type="checkbox" class="form-check-input" name="electricity" value="1"> Electricity *</p>
                          <p> <input type="checkbox" class="form-check-input" name="water" value="1"> Water *</p>
                          <p> <input type="checkbox" class="form-check-input" name="hug_space" value="1"> A huge space *</p>
                        </label>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-4">
                <img src="<?php echo base_url(); ?>assets/images/projects/place_size.jpg" class="float-right img-fluid">
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputName"  class="control-label"><b>Any other needs</b></label>
                  <textarea class="form-control" name="other" id="about" rows="10" required="required">No</textarea>
                </div>
              </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block" value="add">OK</button>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <button type="button" class="btn btn-secondary btn-block" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
                <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
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
