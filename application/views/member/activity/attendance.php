<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted"><i class='far fa-id-badge' style='font-size:80px;color:orange'></i> <?php echo $title; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-12">
      <button type="button" class="btn btn-secondary float-right" onclick="window.history.back();">
          <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
      </button>
    </div>
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group table-responsive">
                  <h4 class="text-info">Table of Attendance data log</h4>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>no</th>
                        <th>Activity</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Date Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=0;
                      foreach ($attendances as $row) {
                        $i++;
                        $activity = $this->Activity_model->fetch_activity_row($row->activity_id)
                        ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $this->Activity_model->get_activity_type($activity->type); ?></td>
                        <td><?php echo $activity->name; ?></td>
                        <td><?php echo $row->status; ?></td>
                        <td><?php echo date_format(date_create($row->update_time),"d-M-Y H:i:sa"); ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <hr/>
    <div class="row">
      <h5 class="text-warning"><i class='fas fa-comment-alt'></i> Note:</h5>
      <h5 class="text-muted">&nbsp;Table of Attendance data log. Data form QR-Code scaner.</h5>
    </div>
  </div>
</div>
