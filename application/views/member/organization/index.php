<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Organization list</h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-9">
    </div>
    <div class="col-sm-3">
      <a href="<?php echo base_url(); ?>members/organization/new" class="btn btn-success btn-block"><i class='fas fa-plus'></i> Add Organization</a>
      <button type="button" class="btn btn-secondary  btn-block" onclick="window.history.back();">
        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
      </button>
    </div>
  </div>
  <div class="row">
    <h5 class="text-info">Organization total: <?php echo count($orgs); ?></h5>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>City</th>
            <th>Province</th>
            <th>country</th>
            <th>Type</th>
            <th>Sister / Hosted by</th>
            <th>Active</th>
            <th>Last update</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orgs as $org) {  ?>
            <tr>
              <td>
                <?php $img_check = file_exists('assets/images/orgs/tjsif2019-org-'.$org->id.'_thumb.jpg');
                if($img_check){ ?>
                  <a href="<?php echo base_url(); ?>members/organization/info/<?php echo $org->id; ?>">
                    <img src="<?php echo base_url(); ?>assets/images/orgs/tjsif2019-org-<?php echo $org->id.'_thumb.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
                  </a>
                <?php }else{ ?>
                  <i class='fas fa-school' style='font-size:120px;color:lightblue'></i>
                <?php  } ?>
              </td>
              <td><a href="<?php echo base_url(); ?>members/organization/info/<?php echo $org->id; ?>" class="lead"><?php echo $org->name ?></a></td>
              <td><?php echo $org->city ?></td>
              <td><?php echo $org->province ?></td>
              <td><?php echo $org->country ?></td>
              <td><?php echo $this->Org_model->fetch_org_type_name($org->type); ?></td>
              <td>
                <?php $div = explode(",",$org->sister); //แยก id sister school ออกมา แช่น 2,5,12 => 2 5 12 ?>
                <?php for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด ดึงชื่อโรงเรียน
                  $o_name = $this->Org_model->fetch_org_name($div[$i]); ?>
                  <a href="<?php echo base_url(); ?>members/organization/info/<?php echo $div[$i]; ?>" class="lead"><?php echo $o_name.'<br>'; ?></a>
                <?php } ?>
              </td>
              <td>
                <?php if($org->active) { ?>
                  <i class='fas fa-check' style='font-size:24px;color:green'></i></span>
                <?php }else{ ?>
                  <i class='far fa-hourglass' style='font-size:24px;color:red'></i></span>
                <?php } ?>
              </td>
              <td><?php echo $org->update_time.'/by '.$org->update_name; ?></td>
            </tr>
          <?php   } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
