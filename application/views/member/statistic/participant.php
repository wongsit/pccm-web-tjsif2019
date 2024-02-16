<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Statistic</h1>
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
    <h3 class="text-success"><b>Registeration Status Member (Participant only)</b></h3>
    <div class="table-responsive">
      <h3 class="text-info">Registered all group.</h3>
      <table class="table" id="rsmtb">
        <thead>
          <tr>
            <th rowspan="2" class="text-center align-middle">Name</th>
            <th colspan="2" class="text-center">Students</th>
            <th colspan="2" class="text-center">Teacher</th>
            <th rowspan="2" class="text-center align-top">Professor</th>
            <th rowspan="2" class="text-center align-top">Deputy	</th>
            <th rowspan="2" class="text-center align-top">Director</th>
            <th rowspan="2" class="text-center align-top">JOVC/JICA</th>
            <th rowspan="2" class="text-center align-top">NP/JF</th>
            <th rowspan="2" class="text-center align-top">The other</th>
            <th rowspan="2" class="text-center align-top">Total</th>
          </tr>
          <tr>
            <th>Male</th>
            <th>Female</th>
            <th>Male</th>
            <th>Female</th>
          </tr>
        </thead>
        <tbody>
          <?php
            //$amout_type = $this->Org_model->count_org_type();   /Org type ทั้งหมด
            $amout_type = 5;
            $count_all_student_male = array(1 => 0);
            $count_all_student_female = array(1 => 0);
            $count_all_teacher_male = array(2 => 0);
            $count_all_teacher_female = array(2 => 0);

            $count_all = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 99 => 0, 'sum' => 0);
            for($i=1;$i<=$amout_type;$i++){
                $orgs = $this->Org_model->fetch_org_group($i);  // //ดึงข้อมูลจาก tb_org 1=pcshs
           ?>

            <?php
            //แสดงตารางข้อมูลจำนวนผู้ลงทะเบียน
            $count_total_student_male = array(1 => 0);
            $count_total_student_female = array(1 => 0);
            $count_total_teacher_male = array(2 => 0);
            $count_total_teacher_female = array(2 => 0);
            $count_total = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 99 => 0, 'sum' => 0);
            foreach ($orgs as $org){ ?>
              <?php  $org->name; ?>
              <?php
              $count_student_male = array(1 => 0);
              $count_student_female = array(1 => 0);
              $count_teacher_male = array(2 => 0);
              $count_teacher_female = array(2 => 0);
              $count = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 99 => 0, 'sum' => 0);
              //วน loop เพื่อนับจำนวนตาม occ_id และ  org_id
              foreach ($occ_types as $occ_type){
                if(intval($occ_type->id) == 1){   //Student
                  $count_student_male[1] = $this->Users_model->users_count_occ_male_org_id_participant($occ_type->id,$org->id);
                  $count_total_student_male[1] += $count_student_male[1];
                  $count_all_student_male[1] += $count_student_male[1];
                  $count_student_female[1] = $this->Users_model->users_count_occ_female_org_id_participant($occ_type->id,$org->id);
                  $count_total_student_female[1] += $count_student_female[1];
                  $count_all_student_female[1] += $count_student_female[1];
                }else if(intval($occ_type->id) == 2){ //Teacher
                  $count_teacher_male[2] = $this->Users_model->users_count_occ_male_org_id_participant($occ_type->id,$org->id);
                  $count_total_teacher_male[2] += $count_teacher_male[2];
                  $count_all_teacher_male[2] += $count_teacher_male[2];
                  $count_teacher_female[2] = $this->Users_model->users_count_occ_female_org_id_participant($occ_type->id,$org->id);
                  $count_total_teacher_female[2] += $count_teacher_female[2];
                  $count_all_teacher_female[2] += $count_teacher_female[2];
                }else{  //Other
                  $count[$occ_type->id] = $this->Users_model->users_count_occ_org_id_participant($occ_type->id,$org->id);
                  $count_total[$occ_type->id] += $count[$occ_type->id]; ?>
                  <?php  $count[$occ_type->id]; $count_all[$occ_type->id] += $count[$occ_type->id]; ?>
                  <?php
                }
              }
              $count['sum'] = $this->Users_model->users_count_org_id_participant($org->id);
              $count_total['sum'] += $count['sum'];   ?>

                <?php
                if($count['sum'] == 0){
                   //echo '<p class="bg-danger text-white"><b>Wait</b></p>';
                }else{
                   $count['sum'];
                }
                ?>


          <?php }  ?>
          <tr>
            <td><?php echo $this->Org_model->fetch_org_type_name($i); ?></td>
            <?php
            //แสดงท้ายตาราง ยอดรวม

            foreach ($occ_types as $occ_type){
              if(intval($occ_type->id) == 1){   //Student ?>
                <td><b><?php echo $count_total_student_male[1]; ?></b></td>
                <td><b><?php echo $count_total_student_female[1]; ?></b></td>
            <?php }else if(intval($occ_type->id) == 2){   //Teacher ?>
                <td><b><?php echo $count_total_teacher_male[2]; ?></b></td>
                <td><b><?php echo $count_total_teacher_female[2]; ?></b></td>
            <?php }else{ ?>
                <td><b><?php echo $count_total[$occ_type->id]; ?></b></td>
            <?php } ?>
            <?php } ?>
            <td><b><?php echo $count_total['sum']; $count_all['sum'] += $count_total['sum']; ?></b></td>

          </tr>
            <?php    } //for?>
            <tr>
              <td>Total</td>
              <?php
            //วน loop เพื่อนับจำนวนตาม occ_id และ  org_id
            foreach ($occ_types as $occ_type){
              if(intval($occ_type->id) == 1){   //Student ?>
                <td><p class="text-success"><b><?php echo $count_all_student_male[1] ?></b></p></td>
                <td><p class="text-success"><b><?php echo $count_all_student_female[1] ?></b></p></td>
            <?php }else if(intval($occ_type->id) == 2){   //Teacher ?>
                <td><p class="text-success"><b><?php echo $count_all_teacher_male[2] ?></b></p></td>
                <td><p class="text-success"><b><?php echo $count_all_teacher_female[2] ?></b></p></td>
            <?php }else{ ?>
              <td><p class="text-success"><b><?php echo $count_all[$occ_type->id] ?></b></p></td>
              <?php  } ?>
          <?php  } ?>
            <td><p class="text-success"><b><?php echo $count_all['sum']; ?></b></p></td>
            </tr>
        </tbody>
      </table>

    </div>
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
                $count[$occ_type->id] = $this->Users_model->users_count_occ_org_id_participant($occ_type->id,$org->id);
                $count_total[$occ_type->id] += $count[$occ_type->id]; ?>
                <td><?php echo $count[$occ_type->id]; $count_all[$occ_type->id] += $count[$occ_type->id]; ?></td>
                <?php
              }
              $count['sum'] = $this->Users_model->users_count_org_id_participant($org->id);
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
