<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Project information</h1>
  <hr class="featurette-divider">
  <div class="row">
    <hr class="featurette-divider">
    <div class="col-sm-12">
          <h2 class="text-info"><?php echo $project->name ?></h2>
      </div>
      <div class="col-sm-6">
        <br>
          <div class="fakeimg">
            <?php $img_check = file_exists('assets/images/projects/tjsif2019-project-'.$project->id.'.jpg');
            if($img_check){ ?>
              <img src="<?php echo base_url(); ?>assets/images/projects/tjsif2019-project-<?php echo $project->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
            <?php }else{ ?>
              <i class='fas fa-drafting-compass' style='font-size:240px;color:lightblue'></i>
            <?php  } ?>
          </div>
        </div>
        <div class="col-sm-6">
          <br>
          <h5 class="text-muted">Objective of project</h5>
          <textarea class="form-control bg-white" name="concept" id="about" rows="12" required="required" readonly><?php echo $project->objective ?></textarea>

      </div>
      <div class="col-sm-12">
        <br>
        <textarea class="form-control bg-white" name="concept" id="about" rows="20" required="required" readonly><?php echo $project->concept ?></textarea>
        <br>
    </div>
      <div class="col-sm-6">
        <br>
        <h5 class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This project categories of
          <?php
        foreach($categorys as $category) {
          if($category->id == $project->category_id){
            echo $category->name;
           } ?>
        <?php }?>
    and presentation style is
        <?php
        foreach($styles as $style) {
          if($style->id == $project->style_id){
            echo $style->name;
          } ?>
        <?php }?>.
       This Project Create by
        <?php $div = explode(",",$project->students); //แยก student id ออกมา แช่น 2,5,12 => 2 5 12 ?>
        <?php foreach($users as $user) { ?>
          <?php if($user->occ_id == 1){ // 1: Students ดูค่าในตาราง tb_occ_type ?>
            <?php for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
              if($user->id == $div[$i]) echo $user->firstname.' '.$user->lastname.', ';
            } ?>
          <?php } ?>
        <?php } ?> They are students form
        <?php
        foreach($orgs as $org) {
          if($org->id == $project->org_id){
            echo $org->name;
           } ?>
        <?php }?> Organization.
        Teaching by
        <?php $div = explode(",",$project->teachers); //แยก teacher id ออกมา แช่น 2,5,12 => 2 5 12 ?>
        <?php foreach($users as $user) { ?>
          <?php if($user->occ_id == 2){ // 2: Teacher ดูค่าในตาราง tb_occ_type ?>
            <?php for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
              if($user->id == $div[$i]) echo $user->firstname.' '.$user->lastname.', ';
            } ?>
          <?php } ?>
        <?php } ?>
      </h5>
      </div>
      <div class="col-sm-6">
        <div class="table-responsive">
          <h3 class="text-info"><b>Documents</b></h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Document</th>
                <th>Downloaded(times)</th>
                <th>Last update</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Abstract (.docx)</td>
                <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-abstract-'.$project->id.'.docx'); //update time ์?></td>
                <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-abstract-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-abstract-'.$project->id.'.docx'); //update time ์?></td>
              </tr>
              <tr>
                <td>Abstract (.pdf)</td>
                <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-abstract-'.$project->id.'.pdf'); //update time ์?></td>
                <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-abstract-'.$project->id.'.pdf'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-abstract-'.$project->id.'.pdf'); //update time ์?></td>
              </tr>
              <tr>
                <td>Full paper (.docx)</td>
                <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-fullpaper-'.$project->id.'.docx'); //update time ์?></td>
                <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-fullpaper-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-fullpaper-'.$project->id.'.docx'); //update time ์?></td>
              </tr>
              <tr>
                <td>Full paper (.pdf)</td>
                <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-fullpaper-'.$project->id.'.pdf'); //update time ์?></td>
                <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-fullpaper-'.$project->id.'.pdf'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-fullpaper-'.$project->id.'.pdf'); //update time ์?></td>
              </tr>
            </tbody>
          </table>
        </div>

  </div>
  <hr class="featurette-divider">
  <div class="col-sm-6">
    <p class="text-muted">
    <?php echo 'Project Last '.$this->lang->line('update_time')." : ".$project->update_time;   //เวลา ?>
    <?php echo " ".$this->lang->line('update_ip')." : ".$project->update_ip;   //ไอพี ?>
    <?php echo " ".$this->lang->line('update_id')." : ".$project->update_name;   //ผู้ปรับปรุง ?>
  </p>
  </div>
</div>
<hr class="featurette-divider">
<div class="col-sm-4">
  <button type="button" class="btn btn-outline-dark btn-lg btn-block" onclick="window.history.back();">
    <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
  </button>
</div>

</div>
</div>
