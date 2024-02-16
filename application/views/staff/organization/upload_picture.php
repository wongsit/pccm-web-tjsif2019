<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Upload picture - <?php echo $org->name; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-6">
      <?php $img_check = file_exists('assets/images/orgs/tjsif2019-org-'.$org->id.'.jpg');
      if($img_check){ ?>
      <img src="<?php echo base_url(); ?>assets/images/orgs/tjsif2019-org-<?php echo $org->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
    <?php }else{ ?>
      <i class='fas fa-school' style='font-size:240px;color:lightblue'></i>
    <?php  } ?>
    <br/>
    </div>
    <hr class="featurette-divider">
    <div class="col-sm-10">
      <div class="card">
        <div class="card-body">
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong>Upload result => </strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open_multipart('staff/organization/do_upload'); ?>
          <?php if($this->session->flashdata('reg_result') == FALSE){ //?>
            <form>
              <div class="form-row">
                <div class="col-md-8">
                  <div class="form-group">
                    <p class="lead">Picture file type (.jpg) only and maximum size less then 1 MB. </p>
                    <input type="file" name="photo" class="btn btn-warning">
                    <button type="submit" class="btn btn-success" value="upload">Update</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
                <input type="hidden" name="org_id" value="<?php echo $org->id; ?>">
                <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
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
