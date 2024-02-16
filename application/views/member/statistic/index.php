<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Statistic</h1>
  <ul class="nav nav-pills">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class='fas fa-filter'></i> Filter</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url(); ?>members/statistic/participant"><i class='fas fa-users'></i> Participant only</a>
      <a class="dropdown-item" href="<?php echo base_url(); ?>members/statistic/participant_observer"><i class='fas fa-users'></i> Participant and Observer</a>
      <a class="dropdown-item" href="<?php echo base_url(); ?>members/statistic/project"><i class='fas fa-drafting-compass'></i> Project</a>
    </div>
  </li>
</ul>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-9">
      <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
    </div>
    <div class="col-sm-3">
      <button type="button" class="btn btn-secondary  btn-block" onclick="window.history.back();">
        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
      </button>
    </div>
  </div>
  <div class="row">
    <h3 class="text-success"><b>Registeration Status Member</b></h3>
    <?php
      //$amout_type = $this->Org_model->count_org_type();   /Org type ทั้งหมด
      $amout_type = 5;
      $count_all = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 99 => 0, 'sum' => 0);
      for($i=1;$i<=$amout_type;$i++){
          $orgs = $this->Org_model->fetch_org_group($i);  // //ดึงข้อมูลจาก tb_org 1=pcshs
     ?>
    <div class="table-responsive">
      <h4 class="text-info"><?php echo $this->Org_model->fetch_org_type_name($i); ?></h4>
      <table class="table" id="rsmtb">
        <thead>
          <tr>
            <th>Name</th>
            <?php
            //แสดงหัวตาราง
            foreach ($occ_types as $occ_type){ ?>
              <th><?php echo $occ_type->name; ?></th>
            <?php } ?>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            //แสดงตารางข้อมูลจำนวนผู้ลงทะเบียน
            $count_total = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 99 => 0, 'sum' => 0);
            foreach ($orgs as $org){ ?>
              <td><?php echo $org->name; ?></td>
              <?php
              $count = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 99 => 0, 'sum' => 0);
              //วน loop เพื่อนับจำนวนตาม occ_id และ  org_id
              foreach ($occ_types as $occ_type){
                $count[$occ_type->id] = $this->Users_model->users_count_occ_org_id($occ_type->id,$org->id);
                $count_total[$occ_type->id] += $count[$occ_type->id]; ?>
                <td><?php echo $count[$occ_type->id]; $count_all[$occ_type->id] += $count[$occ_type->id]; ?></td>
                <?php
              }
              $count['sum'] = $this->Users_model->users_count_org_id($org->id);
              $count_total['sum'] += $count['sum'];   ?>
              <td>
                <?php
                if($count['sum'] == 0){
                  echo '<p class="bg-danger text-white"><b>Wait</b></p>';
                }else{
                  echo $count['sum'];
                }
                ?>
              </td>
            </tr>
          <?php }  ?>
          <tr>
            <td>Total</td>
            <?php
            //แสดงท้ายตาราง ยอดรวม
            foreach ($occ_types as $occ_type){ ?>
              <td><b><?php echo $count_total[$occ_type->id]; ?></b></td>
            <?php } ?>
            <td><b><?php echo $count_total['sum']; $count_all['sum'] += $count_total['sum']; ?></b></td>
          </tr>
        </tbody>
      </table>

    </div>
  <?php    } //for?>

 <div class="table-responsive">
  <h3 class="text-muted">Registered total all group.</h3>
  <table class="table" id="rsmtb">
    <thead>
      <tr>
        <th></th>
        <?php
        //แสดงหัวตาราง
        foreach ($occ_types as $occ_type){ ?>
          <th><?php echo $occ_type->name; ?></th>
        <?php } ?>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Total</td>
        <?php
      //วน loop เพื่อนับจำนวนตาม occ_id และ  org_id
      foreach ($occ_types as $occ_type){  ?>
        <td><p class="text-success"><b><?php echo $count_all[$occ_type->id] ?></b></p></td>
    <?php  } ?>
      <td><p class="text-success"><b><?php echo $count_all['sum']; ?></b></p></td>
      </tr>
    </tbody>
  </table>
    </div>

  </div>
</div>
