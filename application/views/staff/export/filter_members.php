<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-success"><i class='fas fa-envelope'></i> Export by filter</h1>
  <hr class="featurette-divider">
  <div class="row">
    <hr class="featurette-divider">
    <div class="col-sm-12">
    <h3 class="text-muted"><i class='fas fa-users'></i> Filter members</h3>
      <?php //echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
      <?php
      $attributes = array('id' => 'filter');
      echo form_open('staff/export/filter_members',$attributes);
      ?>
      <form>
      <div class="form-row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="title"><b>Country</b></label>
            <select class="form-control" name="country">
              <option value="">---Select---</option>
              <?php
              foreach($countrys as $country) {
                ?>
                <?php
                if($country->id == $selected['country']){ ?>
                  <option value="<?=$country->id?>" selected><?=$country->name?></option>
                <?php } else{ ?>
                <option value="<?=$country->id?>"><?=$country->id?>-<?=$country->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="inputGender"><b>Gender</b></label>
            <select class="form-control" id="gender" name="gender">
              <option value="">---Select---</option>
              <?php
              foreach($genders as $gender) {
                ?>
                <?php
                if($gender->id == $selected['gender']){ ?>
                  <option value="<?=$gender->id?>" selected><?=$gender->name?></option>
                <?php } else{ ?>
                <option value="<?=$gender->id?>"><?=$gender->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="title"><b>Title</b></label>
            <select class="form-control" id="title" name="title">
              <option value="">---Select---</option>
              <?php
              foreach($titles as $title) {
                ?>
                <?php
                if($title->id == $selected['title']){ ?>
                  <option value="<?=$title->id?>" selected><?=$title->name?></option>
                <?php } else{ ?>
                <option value="<?=$title->id?>"><?=$title->name?></option>
                <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="select" class="control-label"><b>Type</b></label>
            <select class="form-control" name="type">
              <option value="">---Select---</option>
              <?php
              foreach($types as $type) {
                ?>
                <?php
                if($type->id == $selected['type']){ ?>
                  <option value="<?=$type->id?>" selected><?=$type->name?></option>
                <?php } else{ ?>
                <option value="<?=$type->id?>"><?=$type->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="select" class="control-label"><b>Occupation</b></label>
            <select class="form-control" name="occ_id">
              <option value="">---Select---</option>
              <?php
              foreach($occ_types as $occ_type) {
                ?>
                <?php
                if($occ_type->id == $selected['occ_id']){ ?>
                  <option value="<?=$occ_type->id?>" selected><?=$occ_type->name?></option>
                <?php } else{ ?>
                <option value="<?=$occ_type->id?>"><?=$occ_type->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label for="select" class="control-label"><b>Organization</b></label>
            <select class="form-control" name="org_id">
              <option value="">---Select---</option>
              <?php
              foreach($orgs as $org) {
                ?>
                <?php
                if($org->id == $selected['org_id']){ ?>
                  <option value="<?=$org->id?>" selected><?=$org->name?></option>
                <?php } else{ ?>
                <option value="<?=$org->id?>"><?=$org->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="select" class="control-label"><b>Food restrictions</b></label>
            <select class="form-control" name="food">
              <option value="">---Select---</option>
              <?php
              foreach($foods as $food) {
                ?>
                <?php
                if($food->id == $selected['food']){ ?>
                  <option value="<?=$food->id?>" selected><?=$food->name?></option>
                <?php } else{ ?>
                <option value="<?=$food->id?>"><?=$food->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="select" class="control-label"><b>field trip</b></label>
          <select class="form-control" name="fieldtrip">
            <option value="">---Select---</option>
            <option value="0">Not selected yet</option>
            <?php
            foreach($fieldtrips as $fieldtrip) {
              ?>
              <?php
              if($fieldtrip->id == $selected['fieldtrip']){ ?>
                <option value="<?=$fieldtrip->id?>" selected><?=$fieldtrip->name?></option>
              <?php }else{ ?>
                <option value="<?=$fieldtrip->id?>"><?=$fieldtrip->name?></option>
              <?php }
            }
            ?>
          </select>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="select" class="control-label"><b>Active</b></label>
          <select class="form-control" name="active">
            <option value="">---Select---</option>
            <?php
            for($i=0;$i<2;$i++) {
              ?>
              <?php
              if($i == $selected['active']){ ?>
                <?php
                if($i==0){
                ?>
                <option value="<?=$i?>" selected><?='False'?></option>
              <?php  }else{ ?>
                <option value="<?=$i?>" selected><?='True'?></option>
              <?php } ?>
              <?php }else{
                if($i==0){
                ?>
                <option value="<?=$i?>"><?='False'?></option>
              <?php  }else{ ?>
                <option value="<?=$i?>"><?='True'?></option>
              <?php }
            }
          }
            ?>
          </select>
        </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
          <button type="submit" name="filter" class="btn btn-warning"><i class='fas fa-filter'></i> Filter</button>
          <a href="<?php echo base_url(); ?>staff/export/clear_filter_members" class="btn"> Clear</a>
          </div>
        </div>
      </form>
      </div>
      <hr class="featurette-divider">
    </div>
    <div class="col-md-12">
    <h1 class="text-muted"><i class='fas fa-list'></i> Members list from filter.</h1>
    <?php
    $attributes = array('id' => 'filter');
    if(isset($selected)){
    $hidden = array(
      'id' => 'download',
      'title' => $selected['title'],
      'gender' => $selected['gender'],
      'country' => $selected['country'],
      'food' => $selected['food'],
      'type' => $selected['type'],
      'occ_id' => $selected['occ_id'],
      'org_id' => $selected['org_id'],
      'fieldtrip' => $selected['fieldtrip'],
      'active' => $selected['active']
    );
  }else{
    $hidden = '';
  }
    echo form_open('staff/export/export_filter_members',$attributes,$hidden);
    ?>
    <form>
    <p class="float-right">
      <button type="submit" id="send" class="btn btn-primary btn-block"><i class='fas fa-cloud-download-alt'></i> Download</button>
    </p>
  </form>
  <?php echo form_close(); ?>
    <label><b>Number of people : <?php echo count($users); ?></b></label>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>school/organization</th>
            <th>occupation</th>
            <th>Type</th>
            <th>email</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          foreach ($users as $row) {
              $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><a href="<?php echo base_url(); ?>staff/profile/index/<?php echo $row->id; ?>" class="lead text-success" target="_blank"><?php echo $this->Users_model->fetch_title_name($row->title) .' '. $row->firstname .' '. $row->lastname ?></a></td>
              <td><?php echo $this->Users_model->fetch_org_name($row->org_id); ?></td>
              <td><?php echo $this->Users_model->fetch_occ_type_name($row->occ_id); ?></td>
              <td><?php echo $this->Users_model->fetch_people_type_name($row->type); ?></td>
              <td><?php echo $row->email; ?></td>
            </tr>
          <?php   } ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
