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
    <h3 class="text-success"><b>Registeration Project Status</b></h3>
    <?php
      //$amout_type = $this->Org_model->count_org_type();   /Org type ทั้งหมด
      $amout_type = 5;
      $count_all = array(1 => 0, 2 => 0, 3 => 0, 'sum' => 0);
      for($i=1;$i<=$amout_type;$i++){
          $orgs = $this->Org_model->fetch_org_group($i);  // //ดึงข้อมูลจาก tb_org 1=pcshs
     ?>
    <div class="table-responsive">
      <h4 class="text-info"><?php echo $this->Org_model->fetch_org_type_name($i); ?></h4>
      <table class="table" id="rsmtb">
        <thead>
          <tr>
            <th>Organization Name</th>
            <th>Project</th>
						<th>Student</th>
						<th>Teacher</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            //แสดงตารางข้อมูลจำนวนผู้ลงทะเบียน
            $count_total = array(1 => 0, 2 => 0, 3 => 0,'sum' => 0);
            foreach ($orgs as $org){ ?>
              <td><?php echo $org->name; ?></td>
              <?php
              $count = array(1 => 0, 2 => 0, 3 => 0, 'sum' => 0);
							//Project
							$project_org = $this->Project_model->fetch_projects_org($org->id);
							$count[1] = count($project_org);
              $count_total[1] += $count[1]; ?>
							<td><?php echo $count[1]; $count_all[1] += $count[1]; ?></td>
						  <?php 	//Student
							foreach ($project_org as $row){
								$div = explode(",",$row->students);
	              $count[2] += count($div)-1;
							}
							$count_total[2] += $count[2];
							 ?>
							<td><?php echo $count[2]; $count_all[2] += $count[2]; ?></td>
							 <?php 	//Teacher
							 foreach ($project_org as $row){
								 $div = explode(",",$row->teachers);
								 $count[3] += count($div)-1;
							 }
							 $count_total[3] += $count[3];
							 ?>
							<td><?php echo $count[3]; $count_all[3] += $count[3]; ?></td>

              <?php
              $count['sum'] = $count[2] + $count[3];
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
          <?php } //forearch  ?>
          <tr>
            <td>Total</td>
            <?php
            //แสดงท้ายตาราง ยอดรวม
            ?>
            <td><b><?php echo $count_total[1]; ?></b></td>
						<td><b><?php echo $count_total[2]; ?></b></td>
						<td><b><?php echo $count_total[3]; ?></b></td>
            <td><b><?php echo $count_total['sum']; $count_all['sum'] += $count_total['sum']; ?></b></td>
          </tr>
        </tbody>
      </table>

    </div>
  <?php   } //for?>

 <div class="table-responsive">
  <h3 class="text-muted">Project total all group.</h3>
  <table class="table" id="rsmtb">
    <thead>
      <tr>
        <th></th>

				<th>Project</th>
				<th>Student</th>
				<th>Teacher</th>
				<th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td>Total</td>
      <td><p class="text-success"><b><?php echo $count_all[1]; ?></b></p></td>
			<td><p class="text-success"><b><?php echo $count_all[2]; ?></b></p></td>
			<td><p class="text-success"><b><?php echo $count_all[3]; ?></b></p></td>
      <td><p class="text-success"><b><?php echo $count_all['sum']; ?></b></p></td>
      </tr>
    </tbody>
  </table>
  </div>

  </div>
</div>
