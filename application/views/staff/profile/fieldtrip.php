<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted"><?php echo $title; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">
      <br>
      <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
      <br>
      <div class="row">
        <?php if($user->trip > 0){?>
          <div class="col-sm-12">
          <h3 class="text-success"><b> You have chosed this field trip.</b></h3>
          <div class="row">
            <div class="col-sm-4">
              <img src="<?php echo base_url(); ?>assets/images/fieldtrip/thai-lao-bridge.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
            </div>
            <div class="col-sm-8">
              <h4 class="text-primary">
                <i class='fas fa-map-marker-alt' style='font-size:68px;color:red'></i>
                <?php
                  $fieldtrip_selected = $this->Users_model->fetch_fieldtrip_row($user->trip);
                  echo $fieldtrip_selected->name;
                ?>
              </h4>
              <p class="lead">Things to learn</p>
              <p>
                <?php
                  echo $fieldtrip_selected->about;
                ?>
              </p>
            </div>
          </div>
          <hr class="featurette-divider">
          <br/>
          </div>
        <?php }else{ ?>
          <div class="col-sm-12">
            <h3 class="text-warning"><i class='fas fa-warning' style='font-size:48px;color:red'></i> You haven't chosen the field trip, right?</h3>
            <p class="lead"> <b>If you still do not choose a field trip, please read the details in Tab. Then, you can choose a location and click the select button.</b>
            <hr class="featurette-divider">
            <br/>
          </div>
        <?php } ?>

        <h1 class="taxt-danger"><i class='fas fa-map-marked-alt'></i> Field trip details</h1>
        <div class="col-sm-12">
          <div class="row">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#status">
                <?php if($user->trip == 0){?>
                  <i class='fas fa-poll' style='font-size:24px;color:lightblue'></i>
                  <b>Status field trip</b>
                <?php }else { ?>
                  <i class='fas fa-poll' style='font-size:24px;color:lightblue'></i>
                  Status field trip
                <?php } ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#Bridge">
                  <?php if($user->trip == 1){?>
                    <i class='fas fa-bus-alt' style='font-size:24px;color:orange'></i>
                    <b>#1:Thai-Laos Bridge</b>
                  <?php }else { ?>
                    <i class='fas fa-bus-alt' style='font-size:24px;color:orange'></i>
                    #1:Thai-Laos Bridge
                  <?php } ?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#PhuPhaTerb">
                  <?php if($user->trip == 2){ ?>
                    <i class='fas fa-bus-alt' style='font-size:24px;color:green'></i>
                    <b>#2:Phu Pha Thoep</b>
                  <?php }else { ?>
                    <i class='fas fa-bus-alt' style='font-size:24px;color:green'></i>
                    #2:Phu Pha Thoep
                  <?php }?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#Inland">
                  <?php if($user->trip == 3){?>
                    <i class='fas fa-bus-alt'  style='font-size:24px;color:pink'></i>
                    <b>#3:Fisheries Station</b>
                  <?php }else {  ?>
                    <i class='fas fa-bus-alt'  style='font-size:24px;color:pink'></i>
                    #3:Fisheries Station
                  <?php }?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#Queen">
                  <?php if($user->trip == 4){?>
                    <i class='fas fa-bus-alt'  style='font-size:24px;color:indigo'></i>
                    <b>#4:Sericulture</b>
                  <?php }else { ?>
                    <i class='fas fa-bus-alt'  style='font-size:24px;color:indigo'></i>
                    #4:Sericulture
                  <?php }?>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-info" data-toggle="tab" href="#Research">
                  <?php if($user->trip == 5){?>
                    <i class='fas fa-bus-alt'  style='font-size:24px;color:blue'></i>
                    <b>#5:Agricultural R&D</b>
                  <?php }else { ; ?>
                    <i class='fas fa-bus-alt'  style='font-size:24px;color:blue'></i>
                    #5:Agricultural R&D
                  <?php }?>
                </a>
              </li>
            </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <br>
                <?php /*********************************************
                  #None
                *****************************************************/ ?>
                <div id="status" class="container tab-pane <?php if($user->trip == 0) echo "active"; ?> ">
                  <?php if($user->trip == 0) {?>
                  <i class='fas fa-arrow-alt-circle-up' style='font-size:128px;color:red'></i>
                  <?php }?>
                  <div class="col-sm-12">
                    <?php if($user->trip == 0) {?>
                    <h3 class="text-danger">You haven't chosen the field trip, right?</h3>
                    <p class="lead"> <b>If you still do not choose a field trip, please read the details in Tab. Then, you can choose a location and click the select button.</b>
                    </p>
                    <?php }?>
                    <hr class="featurette-divider">
                    <p>In this field trip, there are 5 locations. Each location will organize participants with Thai students (not more than 40), Japanese students (not more than 20), and teachers (not more than 30). And there are two tour buses per one location.</p>
                    <h4 class="text-info">Field trip status</h4>
                    <table class="table table-striped table-hover" data-toggle="member">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Field trip</th>
                        <th>Student Thai</th>
                        <th>Student Japan</th>
                        <th>Teacher</th>
                        <th>Bus #<u>x</u>1</th>
                        <th>Bus #<u>x</u>2</th>
                        <th><b>Total</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=0;
                      foreach ($fieldtrips as $row) {
                        $i++; ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row->name; ?></td>
                          <td><?php echo $this->Users_model->count_fieldtrip_student_chose($i,1,'TH'); ?></td>
                          <td><?php echo $this->Users_model->count_fieldtrip_student_chose($i,1,'JP'); ?></td>
                          <td><?php echo $this->Users_model->count_fieldtrip_teacher_chose($i); ?></td>
                          <td><?php echo $this->Users_model->count_fieldtrip_status_bus($i*10+1); ?></td>
                          <td><?php echo $this->Users_model->count_fieldtrip_status_bus($i*10+2); ?></td>
                          <td><?php echo $this->Users_model->count_fieldtrip_status($i); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  </div>
                </div>
                <div id="Bridge" class="container tab-pane <?php if($user->trip == 1) echo "active"; ?> "><br>
                  <?php /*********************************************
                    #1
                  *****************************************************/ ?>
                  <div class="col-sm-12">
                    <br/><h1 class="text-info"><b>Thai-Laos Friendship Bridge Mukdahan</b></h1>
                    <p>
                      To study the properties of water in the Mekong River by using various types of sensors such as temperature, pH and the concentration of magnesium ions via application.
                    </p>
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/thai-lao-bridge.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">

                    <br /><hr class="featurette-divider">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/1/1.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/1/2.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/1/3.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/1/4.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/1/5.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/1/6.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">

                  </div>
                </div>
                <?php /*********************************************
                  #2 Phu Pha Terb National Park
                *****************************************************/ ?>
                <div id="PhuPhaTerb" class="container tab-pane <?php if($user->trip == 2) echo "active"; ?> "><br>
                  <div class="col-sm-12">
                    <br/><h1 class="text-info"><b>Phu Pha thoep National Park</b></h1>
                    <p>To study the changes of the crust and the shape of various types of rocks and do activities by using sensors to measure light intensity, humidity, temperature at Phu Pha Toep National Park.</p>

                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/phatheb.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">

                    <br /><hr class="featurette-divider">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/2/1.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/2/2.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/2/3.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/2/4.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/2/5.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">


                  </div>
                </div>
                <?php /*********************************************
                  #3
                *****************************************************/ ?>
                <div id="Inland" class="container tab-pane<?php if($user->trip == 3) echo "active"; ?> "><br>
                  <div class="col-sm-12">
                    <br/><h1 class="text-info"><b>Mukdahan Inland Fisheries Station </b></h1>
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/3.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">

                    <p></p>
                    <br /><hr class="featurette-divider">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/3/1.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/3/2.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/3/3.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/3/4.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">


                  </div>
                </div>
                <?php /*********************************************
                  #4
                *****************************************************/ ?>
                <div id="Queen" class="container tab-pane <?php if($user->trip == 4) echo "active"; ?> "><br>
                  <div class="col-sm-12">
                    <br/><h1 class="text-info"><b>The Queen Sirikit Department of Sericulture</b></h1>
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/4.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <p></p>
                    <br /><hr class="featurette-divider">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/4/1.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/4/2.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/4/3.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/4/4.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">

                  </div>
                </div>
                <?php /*********************************************
                  #5
                *****************************************************/ ?>
                <div id="Research" class="container tab-pane <?php if($user->trip == 5) echo "active"; ?> "><br>
                  <div class="col-sm-12">
                    <br/><h1 class="text-info"><b>Mukdahan Agricultural Research and Development Centre</b></h1>
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">

                    <p></p>
                    <br /><hr class="featurette-divider">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5/1.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5/2.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5/3.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5/4.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5/5.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5/6.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">

                  </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>

      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <?php echo form_open('staff/profile/chose_fieldtrip'); ?>
              <form>
                <div class="form-row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h1 class="text-warning"><i class='fas fa-hand-point-right'></i> <b>Choose a field trip here.</b></h1>
                      <p>If you still do not choose a field trip, please read the details in Tab. Then, you can choose a location and click the select button.</p>
                      <select class="form-control" name="fieldtrip" required="required" >
                        <option value="">---Select---</option>
                        <?php
                        foreach($fieldtrips as $fieldtrip) {
                          ?>
                          <?php
                          if($fieldtrip->id == $user->trip){ ?>
                            <option value="<?=$fieldtrip->id?>" selected><?=$fieldtrip->name?></option>
                          <?php }else{ ?>
                            <option value="<?=$fieldtrip->id?>"><?=$fieldtrip->name?></option>
                          <?php }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-block btn-primary" value="select">Select</button>
                      <button type="button" class="btn btn-block btn-secondary" onclick="window.history.back();">
                        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
                      </button>
                    </div>
                  </div>
                  <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                  <input type="hidden" name="occ_id" value="<?php echo $user->occ_id; ?>">
                  <input type="hidden" name="country" value="<?php echo $user->country; ?>">
                  <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
                  <input type="hidden" name="update_time" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d H:i:s"); ?>">
                  <input type="hidden" name="update_name" value="<?php echo 'Staff('.$this->session->userdata('firstname').')'; ?>">
                </div>
              </form>
            <?php echo form_close(); ?>

          </div>
        </div>
      </div>
  </div>


</div>
</div>
