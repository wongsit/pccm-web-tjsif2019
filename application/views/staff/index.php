<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted"><i class='fas fa-chart-pie' style='font-size:80px;color:orange'></i> <?php echo $title; ?></h1>
  <ul class="nav nav-pills">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Menu</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url(); ?>staff/activity/export_checkin" target="_blank">Export excel</a>
    </div>
  </li>
</ul>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-12">

        <div class="card-columns">
          <div class="card bg-primary">
            <div class="card-body text-center">
              <i class='fas fa-users' style='font-size:64px;color:white'></i>
              <h6 class="text-white">Members</h6>
              <h1 class="display-1 text-white"><b><?php echo count($users).'/'.count($checkins); ?></b></h1>
            </div>
          </div>
            <div class="card bg-warning">
              <div class="card-body text-center">
                <i class='fas fa-drafting-compass' style='font-size:64px;color:white'></i>
                <h6 class="text-white">PROJECT</h6>
                <h1 class="display-1 text-white"><b><?php echo count($projects); ?></b></h1>
              </div>
            </div>
            <div class="card bg-success">
              <div class="card-body text-center">
                <i class='fas fa-school' style='font-size:64px;color:white'></i>
                <h6 class="text-white">Organizations</h6>
                <h1 class="display-1 text-white"><b><?php echo count($orgs); ?></b></h1>
              </div>
            </div>

        </div>
      </div>
    </div>

  <hr/>
  <div class="row">
    <h5 class="text-warning"><i class='fas fa-comment-alt'></i> Note:</h5>
    <h5 class="text-muted">&nbsp;Check registration staff TJSIF2019. Please check the registration details before pressing the confirm button.</h5>

  </div>
</div>
