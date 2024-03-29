<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Import files - <?php echo $title; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <hr class="featurette-divider">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo $this->session->flashdata('msg_add'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo $this->session->flashdata('msg_update'); //แสดงผลลัพท์จากระบบ ?>

          <?php echo form_open_multipart('staff/member/import_hostel_file'); //ใช้ form_open ?>
            <form>
              <div class="col-md-12">
                <label class="text-info">*Select Spreadsheet file for upload (.xlsx)</label>
                <div class="input-group mb-3">
                  <input type="file"  name="file" id="file" required accept=".xls, .xlsx"  class="btn btn-outline-secondary">
                  &nbsp;<button type="submit" name="import" class="btn btn-primary" value="Import"><i class="fas fa-upload"></i> <?php echo $this->lang->line('upload'); ?></button>
                </div>
              </div>
            </form>
            <?php echo form_close(); ?>

          </div>
        </div>
      </div>
    </div>

    <hr class="featurette-divider">
  <?php if(isset($members)){?>
    <?php echo form_open_multipart('staff/member/hostel_search'); //ใช้ form_open ?>
    <div class="col-md-4">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
          </div>
          <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-success" type="submit" value="search">Search</button>
        </div>
      </div>
      <p class="text-secondary">(press keyword user id)</p>
    </div>
  <?php echo form_close(); ?>

  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Project presentation
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <p class="text-success">Result: <?php echo count($members); ?> row</p>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Name</th>
              <th>Hostel name</th>
              <th>Room</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($members as $row) { // วนลูป แสดงข้อมูล ทีละแถว?>
            <tr>
              <td><?php echo $row->user_id; ?></td>
              <td><?php echo $this->Users_model->fetch_user_name($row->user_id); ?></td>
              <td><?php echo $row->hostel_name; ?></td>
              <td><?php echo $row->room; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">
      <?php echo $this->lang->line('update_time')." : ".$date_time_stamp;   //เวลา ?>
      <?php echo " ".$this->lang->line('update_ip')." : ".$my_ip;   //ไอพี ?>
      <?php echo " ".$this->lang->line('update_id')." : ".$this->session->userdata('username');   //ผู้ปรับปรุง ?>
    </div>
  </div>
  <?php } //if ?>

  </div>
</div>
<hr class="featurette-divider">
</div>
