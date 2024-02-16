<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Members</h1>
  <div class="row">
    <div class="col-sm-10">
      <a href="<?php echo base_url(); ?>staff/member/add" class="btn btn-outline-success"><i class='fas fa-user-plus'></i> Add member</a>
      <a href="<?php echo base_url(); ?>staff/member/print_card_all" class="btn btn-outline-success" target="_blank"><i class='fas fa-print'></i> Print card all</a>
    </div>
    <div class="col-sm-2">
      <button type="button" class="btn btn-secondary btn-block" onclick="window.history.back();">
          <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
      </button>
    </div>
  </div>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-12">
        <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
      <?php foreach ($orgs as $org) { ?>
        <li class="nav-item">
          <a class="nav-link text-success <?php if($org->id == $this->session->userdata('org_id')){ echo ' active'; }?>" data-toggle="tab" href="#org<?php echo $org->id; ?>">
          <?php   if($org->shortname != ''){
              echo $org->shortname;   //show shortname
            }else{
              echo $org->name;    //show name
            } ?>
          </a>
        </li>
      <?php }?>
    </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <?php foreach ($orgs as $org) { ?>
        <div id="org<?php echo $org->id ?>" class="container tab-pane table-responsive <?php if($org->id == $this->session->userdata('org_id')){ echo ' active'; }else{ echo ' fade';} ?>"><br>
          <a href="<?php echo base_url(); ?>staff/member/print_card_org/<?php echo $org->id; ?>" class="btn btn-outline-success text-left float-right" target="_blank"><i class='fas fa-print'></i> Print card</a>
          <br/>
          <table class="table table-striped table-hover" data-toggle="member">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Nickname</th>
              <th>Occupation</th>
              <th>Type</th>
              <th>Active</th>
              <th>field trip</th>
              <th>Print Card</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) {
              if($user->org_id == $org->id){ ?>
              <tr>
                <td> <?php $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$user->id.'_thumb.jpg');
                  if($img_check){ ?>
                    <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $user->id.'_thumb.jpg'; ?>" class="rounded-circle" width="48" alt="Cinque Terre">
                <?php }else{ ?>
                    <i class='fas fa-user' style='font-size:48px;color:lightblue'></i>
                <?php  } ?>
                </td>
                <td><a href="<?php echo base_url(); ?>staff/profile/index/<?php echo $user->id; ?>" class="lead text-success"> <?php echo $user->firstname.' '.$user->lastname; ?></a></td>
                <td> <?php echo $user->nickname; ?></td>
                <td><?php echo $this->Users_model->fetch_occ_type_name($user->occ_id); ?></td>
                <td><?php echo $this->Users_model->fetch_people_type_name($user->type); ?></td>
                <td>
                  <?php if($user->active) { ?>
                    <i class='fas fa-check' style='font-size:24px;color:green'></i></span>
                  <?php }else{ ?>
                    <i class='far fa-hourglass' style='font-size:24px;color:red'></i></span>
                  <?php } ?>
                </td>
                <td>
                  <a href="<?php echo base_url(); ?>staff/profile/fieldtrip/<?php echo $user->id; ?>" title="<?php echo $this->Users_model->fetch_fieldtrip_name($user->trip); ?>">
                    <?php if($user->trip > 0){
                      echo '<p class="text-success">Selected</p>';
                    }else{
                      echo '<p class="text-danger">Not yet</p>';
                    } ?>
                  </a>
                </td>
                <td><a href="<?php echo base_url(); ?>staff/profile/print_card/<?php echo $user->id; ?>" class="btn text-left float-right" target="_blank"><i class='fas fa-print'></i></a></td>
              </tr>
          <?php }
        } ?>
          </tbody>
        </table>
        </div>
      <?php } ?>
      </div>
    </div>
    </div>
</div>
