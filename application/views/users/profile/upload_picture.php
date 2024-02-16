<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Edit Profile - <?php echo $user->firstname.' '.$user->lastname; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-4">
      <h3>Don’t be a stranger</h3>
      <?php $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$user->id.'.jpg');
      if($img_check){ ?>
      <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $user->id.'.jpg'; ?>" class="rounded-circle img-responsive d-block w-100" alt="Cinque Terre">
    <?php }else{ ?>
      <i class='fas fa-user' style='font-size:240px;color:lightblue'></i>
    <?php  } ?>
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
          <?php echo form_open_multipart('users/profile/do_upload'); ?>
          <?php if($this->session->flashdata('reg_result') == FALSE){ //?>
            <form>
              <div class="form-row">
                <div class="col-md-8">
                  <div class="form-group">
                    <input type="file" name="photo" class="btn btn-warning">
                    <button type="submit" class="btn btn-success" value="upload">Update</button>
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
