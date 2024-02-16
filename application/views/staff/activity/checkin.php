<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted"><i class='far fa-id-badge' style='font-size:80px;color:orange'></i> <?php echo $title; ?></h1>
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
    <div class="col-sm-9">
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
            <?php
                //คำนวน prograss data โดยนับจำนวนข้อมูลที่กรอก / ข้อมูลที่ต้องกรอก *100
                $count_success = 0;
                if($user->firstname != '') $count_success +=1;
                if($user->middlename != '') $count_success +=1;
                if($user->lastname != '') $count_success +=1;
                if($user->nickname != '') $count_success +=1;
                if($user->title != '') $count_success +=1;
                if($user->gender != '') $count_success +=1;
                if($user->address1 != '') $count_success +=1;
                if($user->address2 != '') $count_success +=1;
                if($user->city != '') $count_success +=1;
                if($user->country != '') $count_success +=1;
                if($user->province != '') $count_success +=1;
                if($user->zip != '') $count_success +=1;
                if($user->tel != '') $count_success +=1;
                if($user->chronic != '') $count_success +=1;
                if($user->allergies != '') $count_success +=1;
                if($user->food != '') $count_success +=1;
                if($user->type != '') $count_success +=1;
                if($user->occ_id != '') $count_success +=1;
                if($user->org_id != '') $count_success +=1;
                if($user->about != '') $count_success +=1;
                $progress = $count_success / 20*100;
               ?>
              <label>Profile completeness</label>
            <div class="progress">
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width:<?php echo round($progress,2); ?>%"><?php echo round($progress,2); ?>%</div>
              <br>
            </div>
            <?php if($same == 1 ){ //ถ้ายังไม่เช็คอิน ?>
              <br/>
              <h1 class="text-success float-right"><i class='fas fa-user-check' style='font-size:24px;color:green'></i> CHECKED</h1>
              <br/>
          <?php } ?>

          </div>
            <div class="col-sm-8 card">
              <div class="card-body">
                <?php echo form_open('staff/activity/checkin_confirm'); ?>
                  <form>
                    <div class="form-row">
                      <div class="col-md-12">
                        <div class="form-group table-responsive">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td>About me:</td>
                                <td><?php echo $user->about; ?></td>
                              </tr>
                              <tr>
                                <td>Email:</td>
                                <td><?php echo $user->email; ?></td>
                              </tr>
                              <tr>
                                <td>Title:</td>
                                <td>
                                  <?php
                                  foreach($titles as $title) {
                                    if($title->id == $user->title){ ?>
                                      <?php echo $title->name; ?>
                                    <?php }
                                  }?>
                                </td>
                              </tr>
                              <tr class="table-primary">
                                <td>Name: </td>
                                <td><?php echo $user->firstname.' '.$user->lastname; ?></td>
                              </tr>
                              <tr>
                                <td>Middlename: </td>
                                <td><?php echo $user->middlename; ?></td>
                              </tr>
                              <tr>
                                <td>Nickname: </td>
                                <td><?php echo $user->nickname; ?></td>
                              </tr>
                              <tr class="table-warning">
                                <td>Gender: </td>
                                <td>
                                  <?php
                                  foreach($genders as $gender) {
                                    if($gender->id == $user->gender){ ?>
                                      <?php echo $gender->name; ?>
                                    <?php }
                                  }?>
                                </td>
                              </tr>
                              <tr>
                                <td>Address:</td>
                                <td>
                                  <?php echo $user->address1; ?>
                                  <?php echo $user->address2; ?>
                                </td>
                              </tr>
                              <tr>
                                <td>City:</td>
                                <td><?php echo $user->city; ?></td>
                              </tr>
                              <tr>
                                <td>Province:</td>
                                <td><?php echo $user->province; ?></td>
                              </tr>
                              <tr>
                                <td>Zip:</td>
                                <td><?php echo $user->zip; ?></td>
                              </tr>
                              <tr  class="table-success">
                                <td>Country:</td>
                                <td>
                                  <?php
                                  foreach($countrys as $country) {
                                    if($country->id == $user->country){ ?>
                                      <?php echo $country->name; ?>
                                    <?php }
                                  }?>
                                </td>
                              </tr>
                              <tr>
                                <td>Phone number:</td>
                                <td><?php echo $user->tel; ?></td>
                              </tr>
                              <tr>
                                <td>Chronic diseases:</td>
                                <td><?php echo $user->chronic; ?></td>
                              </tr>
                              <tr>
                                <td>Allergies:</td>
                                <td><?php echo $user->allergies; ?></td>
                              </tr>
                              <tr  class="table-danger">
                                <td>Food restrictions:</td>
                                <td>
                                  <?php
                                  foreach($foods as $food) {
                                    if($food->id == $user->food){ ?>
                                      <?php echo $food->name; ?>
                                    <?php }
                                  }?>
                                </td>
                              </tr>
                              <tr>
                                <td>Blood type:</td>
                                <td><?php echo $user->position; ?></td>
                              </tr>
                              <tr>
                                <td>Type:</td>
                                <td>
                                  <?php
                                  foreach($types as $type) {
                                    if($type->id == $user->type){ ?>
                                      <?php echo $type->name; ?>
                                    <?php }
                                  }?>
                                </td>
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
                      <input type="hidden" name="id" value="">  <?php //1=Checkin ?>
                      <input type="hidden" name="activity_id" value="1">  <?php //1=Checkin ?>
                      <input type="hidden" name="member_id" value="<?php echo $user->id; ?>">
                      <input type="hidden" name="staff_id" value="<?php echo $this->session->userdata('id'); ?>">
                      <input type="hidden" name="update_ip" value="<?php echo $my_ip; ?>">
                      <input type="hidden" name="update_time" value="<?php echo $date_time_stamp; ?>">

                      <?php if($same == 0 ){ //ถ้ายังไม่เช็คอิน ?>
                      <br/>
                      <button type="submit" class="btn btn-danger btn-lg float-right" value="confirm"><i class='fas fa-user-check' style='font-size:24px;color:white'></i> Confirm</button>
                      <br/>
                    <?php } ?>
                    </form>
                  <?php echo form_close(); ?>
                  <div>
                  </div>
                </div>
              </div>

          </div>

      <?php }else if(isset($user2)){ // ?>
          <h3 class="text-muted">Personal information</h3>
          <div class="row">
            <div class="col-sm-12 card">
              <div class="card-body">
                    <div class="form-row">
                      <div class="col-md-12">
                        <div class="form-group table-responsive">
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
                                <td><a href="<?php echo base_url(); ?>staff/activity/select_info/<?php echo $user->id; ?>" class="btn btn-danger" role="button">Select</a></i></td>
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
      <?php }else{ ?>
        <div class="card-columns">
          <div class="card bg-primary">
            <div class="card-body text-center">
              <h6 class="text-white">REGISTER</h6>
              <h1 class="display-1 text-white"><b><?php if(isset($users)){ echo count($users); } ?></b></h1>
            </div>
          </div>
          <div class="card bg-warning">
            <div class="card-body text-center">
              <h6 class="text-white">CHECK IN</h6>
              <h1 class="display-1 text-white"><b><?php if(isset($checkin)){ echo count($checkin); } ?></b></h1>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 card">
            <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-group table-responsive">
                        <h4 class="text-success">Check-in information table.</h4>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Organization</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if(isset($checkin)){
                            foreach($checkin as $user){
                            ?>
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
                            </tr>
                          <?php } //foreach
                        }    //if }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                <div>
                </div>
              </div>
            </div>
        </div>

      <?php } ?>


      </div>
    </div>

    <div class="col-sm-3">
      <?php echo form_open('staff/activity/check_in_info'); ?>
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
  </div>
  <hr/>
  <div class="row">
    <h5 class="text-warning"><i class='fas fa-comment-alt'></i> Note:</h5>
    <h5 class="text-muted">&nbsp;Check registration staff TJSIF2019. Please check the registration details before pressing the confirm button.</h5>

  </div>
</div>
