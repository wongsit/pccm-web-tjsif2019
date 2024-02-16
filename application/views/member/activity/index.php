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
                  <h4 class="text-success">Register</h4>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Activity</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($registers as $row) { ?>
                      <tr>
                        <td><?php echo date_format(date_create($row->date),"d-M-Y"); ?></td>
                        <td><?php echo $row->start; ?></td>
                        <td><?php echo $row->end; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date_format(date_create($row->update_time),'d-M-Y'); ?></td>
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

        <div class="col-sm-12">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group table-responsive">
                  <h4 class="text-primary">Roll Call at Students' Dormitory</h4>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Dormitory Name</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dormitorys as $row) { ?>
                      <tr>
                        <td><?php
                        $date = date_create($row->date);

                        echo date_format($date,"d-M-Y").' - '.date_format(date_add($date,date_interval_create_from_date_string("3 days")),"d-M-Y");
                        ?></td>
                        <td><?php echo $row->start; ?></td>
                        <td><?php echo $row->end; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date_format(date_create($row->update_time),'d-M-Y'); ?></td>
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

        <div class="col-sm-12">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group table-responsive">
                  <h4 class="text-warning">Oral Presentation</h4>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Presentation Room</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($presents as $row) { ?>
                      <tr>
                        <td><?php
                        $date = date_create($row->date);
                        echo date_format($date,"d-M-Y");
                        ?></td>
                        <td><?php echo $row->start; ?></td>
                        <td><?php echo $row->end; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date_format(date_create($row->update_time),'d-M-Y'); ?></td>
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

        <div class="col-sm-12">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group table-responsive">
                  <h4 class="text-danger">Teacher show and share</h4>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Venue</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($shares as $row) { ?>
                      <tr>
                        <td><?php
                        $date = date_create($row->date);
                        echo date_format($date,"d-M-Y");
                        ?></td>
                        <td><?php echo $row->start; ?></td>
                        <td><?php echo $row->end; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date_format(date_create($row->update_time),'d-M-Y'); ?></td>
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

        <div class="col-sm-12">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group table-responsive">
                  <h4 class="text-info">ICT Workshop</h4>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Venue</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($workshops as $row) { ?>
                      <tr>
                        <td><?php
                        $date = date_create($row->date);
                        echo date_format($date,"d-M-Y");
                        ?></td>
                        <td><?php echo $row->start; ?></td>
                        <td><?php echo $row->end; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date_format(date_create($row->update_time),'d-M-Y'); ?></td>
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

        <div class="col-sm-12">
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group table-responsive">
                  <h4 class="text-info">Field trip</h4>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Venue</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($fieldtrips as $row) { ?>
                      <tr>
                        <td><?php
                        $date = date_create($row->date);
                        echo date_format($date,"d-M-Y");
                        ?></td>
                        <td><?php echo $row->start; ?></td>
                        <td><?php echo $row->end; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo date_format(date_create($row->update_time),'d-M-Y'); ?></td>
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
      <h5 class="text-muted">&nbsp;Activity for member registered and participant.</h5>
    </div>
  </div>
</div>
