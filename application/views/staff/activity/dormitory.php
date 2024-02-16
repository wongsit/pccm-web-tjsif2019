<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted"><i class='fas fa-building' style='font-size:80px;color:orange'></i> <?php echo $title; ?></h1>
  <ul class="nav nav-pills">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Menu</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo base_url(); ?>staff/activity/export_dormitory/<?php echo $activity_id.'/2019-12-19'; ?>" target="_blank">Export 19 Dec 2019</a>
        <a class="dropdown-item" href="<?php echo base_url(); ?>staff/activity/export_dormitory/<?php echo $activity_id.'/2019-12-20'; ?>" target="_blank">Export 20 Dec 2019</a>
        <a class="dropdown-item" href="<?php echo base_url(); ?>staff/activity/export_dormitory/<?php echo $activity_id.'/2019-12-21'; ?>" target="_blank">Export 21 Dec 2019</a>
        <a class="dropdown-item" href="<?php echo base_url(); ?>staff/activity/export_dormitory/<?php echo $activity_id.'/2019-12-22'; ?>" target="_blank">Export 22 Dec 2019</a>
        <a class="dropdown-item" href="<?php echo base_url(); ?>staff/activity/export_dormitory/<?php echo $activity_id.'/2019-12-23'; ?>" target="_blank">Export 23 Dec 2019</a>
      </div>
    </li>
  </ul>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">

      <?php echo $this->session->flashdata('msg_info');   //แสดงผลลัพท์จากระบบ ?>
      <?php if(isset($user)){ // ?>
          <h3 class="taxt-info">Personal information</h3>
          <div class="row">
            <div class="col-sm-4">
              <?php $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$user->id.'.jpg');
              if($img_check){ ?>
                <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $user->id.'.jpg'; ?>" class="rounded-circle img-responsive  d-block w-100" alt="Cinque Terre">
              <?php }else{ ?>
                <h3>Don’t be a stranger</h3>
                <i class='fas fa-user' style='font-size:120px;color:lightblue'></i>
              <?php  } ?>
            </div>
            <div class="col-sm-8 table-responsive">
              <div class="card-body">
                <?php echo form_open(''); ?>
                <?php
                /* input text Hidden */
                $data_hidden = array(
                  'id'  => $user->id
                );
                echo form_hidden($data_hidden);
                ?>
                <form>
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <table class="table">
                          <tbody>
                            <tr class="table-primary">
                              <td>Name: </td>
                              <td><?php
                                foreach($titles as $title) {
                                  if($title->id == $user->title){
                                    echo $title->name.' ';
                                  }
                                }
                                echo $user->firstname.' '.$user->lastname;
                              ?></td>
                            </tr>
                            <tr>
                              <td>Nickname: </td>
                              <td><?php echo $user->nickname; ?></td>
                            </tr>
                            <tr>
                              <td>Phone number:</td>
                              <td><?php echo $user->tel; ?></td>
                            </tr>
                            <tr>
                              <td>Occupation:</td>
                              <td>
                                <?php
                                foreach($occ_types as $occ_type) {
                                  if($occ_type->id == $user->occ_id){ ?>
                                    <?php echo $occ_type->name; ?>
                                  <?php }
                                }?>
                              </td>
                            </tr>
                            <tr  class="table-info">
                              <td>Organization:</td>
                              <td>
                                <?php
                                foreach($orgs as $org) {
                                  if($org->id == $user->org_id){ ?>
                                    <?php echo $org->name; ?>
                                  <?php }
                                }?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </form>
                  <?php echo form_close(); ?>
                  <div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="featurette-divider">
        <?php } ?>

        <?php if(isset($user2)){ // ?>
          <div class="col-sm-12">
            <h3 class="text-muted">Personal information</h3>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12 table-responsive">
                      <div class="form-group">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Organization</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($user2 as $user){ ?>
                              <tr>
                                <td><?php echo $user->firstname; ?></td>
                                <td><?php echo $user->lastname; ?></td>
                                <td>
                                  <?php
                                  foreach($orgs as $org) {
                                    if($org->id == $user->org_id){ ?>
                                      <?php echo $org->name; ?>
                                    <?php }
                                  }?>
                                </td>
                                <td><a href="<?php echo base_url(); ?>staff/activity/select_dormitory_info/<?php echo $user->id.'/'.$activity_id; ?>" class="btn btn-danger" role="button">Select</a></i></td>
                              </tr>
                            <?php } //foreach    }?>
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
          <hr class="featurette-divider">
        <?php } ?>

        <div class="col-sm-12">
          <div class="card-columns">
            <div class="card bg-primary">
              <div class="card-body text-center">
                <h6 class="text-white">All GUESTS</h6>
                <h1 class="display-1 text-white"><b><?php if(isset($users)){ echo count($users); } ?></b></h1>
              </div>
            </div>
            <div class="card bg-success">
              <div class="card-body text-center">
                <h6 class="text-white">CHECKED</h6>
                <h1 class="display-1 text-white"><b><?php if(isset($in)){ echo count($in); } ?></b></h1>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-body">
                <div class="form-row">
                  <div class="col-md-12 table-responsive">
                    <div class="form-group">
                      <h4 class="text-success">Table of status "IN".</h4>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>no</th>
                            <th>Member ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Organization</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if(isset($in)){
                            $i=0;
                            foreach($in as $row){
                              $i++;
                              $user = $this->Users_model->fetch_user_data_id($row->member_id)
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->firstname; ?></td>
                                <td><?php echo $user->lastname; ?></td>
                                <td>
                                  <?php
                                  foreach($orgs as $org) {
                                    if($org->id == $user->org_id){ ?>
                                      <?php echo $org->name; ?>
                                    <?php }
                                  }?>
                                </td>
                              </tr>
                            <?php } //foreach
                             } ?>
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

    </div><!-- 8888 -->

    <div class="col-sm-4 card">
      <?php echo form_open('staff/activity/dormitory_info'); ?>
      <?php
      /* input text Hidden */
      $data_hidden = array(
        'activity_id'  => $activity_id
      );
      echo form_hidden($data_hidden);
      ?>
      <form>
        <i class='fas fa-barcode' style='font-size:60px;color:red'></i><i class='fas fa-barcode' style='font-size:60px;color:orange'></i><i class='fas fa-barcode' style='font-size:60px;color:green'></i><i class='fas fa-barcode' style='font-size:60px;color:blue'></i>
        <h3 class="text-primary">For the card scan</h3>
        <div class="form-group">
          <input type="text" name="id" class="form-control" value="" placeholder="QR code" autofocus>
        </div>
        <h5 class="text-muted">or type word below</h5>
        <div class="form-group">
          <input type="text"  name="firstname"  class="form-control" value="" placeholder="Firstname">
          <input type="text"  name="lastname"  class="form-control" value="" placeholder="Lastname">
        </div>
        <button type="submit" class="btn btn-primary btn-block" value="login">Search</button>
        <br/>
      </form>
      <?php echo form_close(); ?>

      <button type="button" class="btn btn-secondary  btn-block" onclick="window.history.back();">
        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
      </button>
    </div>

    <hr/>
    <div class="row">
      <h5 class="text-warning"><i class='fas fa-comment-alt'></i> Note:</h5>
      <h5 class="text-muted">&nbsp;Check registration staff TJSIF2019. Please check the member details before authorize.</h5>
    </div>

  </div>
</div>
