<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Upload files comment - <?php echo $project->name; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
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
          <?php echo form_open_multipart('members/project/do_upload_file_comment/'.$file_name); ?>
          <?php if($this->session->flashdata('reg_result') == FALSE){ //?>
            <form>
              <div class="form-row">
                <div class="col-md-8">
                  <div class="form-group">
                    <p class="lead">Upload file <?php echo $file_name; ?> type (.docx|.pdf) only and maximum size less then 10 MB. </p>
                    <input type="file" name="document" class="btn btn-warning">
                    <button type="submit" class="btn btn-success" value="upload">Upload file</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">
                      <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Cancel
                    </button>
                  </div>
                </div>
                <input type="hidden" name="name" value="<?php echo $file_name ?>">
                <input type="hidden" name="project_id" value="<?php echo $project->id; ?>">
                <input type="hidden" name="status" value="0">
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
