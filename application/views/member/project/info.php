<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Project information - <?php echo $project->name; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-6">
          <?php $img_check = file_exists('assets/images/projects/tjsif2019-project-'.$project->id.'.jpg');
          if($img_check){ ?>
            <img src="<?php echo base_url(); ?>assets/images/projects/tjsif2019-project-<?php echo $project->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
          <?php }else{ ?>
            <i class='fas fa-drafting-compass' style='font-size:240px;color:lightblue'></i>
          <?php  } ?>
        </div>
        <div class="col-sm-8">
          <?php
          //คำนวน prograss data โดยนับจำนวนข้อมูลที่กรอก / ข้อมูลที่ต้องกรอก *100
          $count_success = 0;
          if($img_check) $count_success +=1;
          if($project->name != '') $count_success +=1;
          if($project->concept != '') $count_success +=1;
          if($project->objective != '') $count_success +=1;
          if($project->category_id != '') $count_success +=1;
          if($project->style_id != '') $count_success +=1;
          if($project->org_id != '') $count_success +=1;
          if($project->students != '') $count_success +=1;
          if($project->teachers != '') $count_success +=1;
          if($this->Project_model->count_project_file($project->id) == 4) $count_success +=1;
          //if($project->active != '') $count_success +=1;
          $progress = $count_success / 10*100;
          ?>
          <label>Project data completeness</label>
          <div class="progress">
            <?php if($progress == 100){ ?>
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:<?php echo round($progress,2); ?>%"><?php echo  round($progress,2); ?>%</div>
            <?php }else{ ?>
              <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:<?php echo round($progress,2); ?>%"><?php echo  round($progress,2); ?>%</div>
            <?php }?>
            <br>
          </div>
        </div>
        <div class="col-sm-12">
          <?php echo 'Last '.$this->lang->line('update_time')." : ".$project->update_time;   //เวลา ?>
          <?php echo " ".$this->lang->line('update_ip')." : ".$project->update_ip;   //ไอพี ?>
          <?php echo " ".$this->lang->line('update_id')." : ".$project->update_name;   //ผู้ปรับปรุง ?>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="row">
        <div class="col-sm-10">
          <button type="button" class="btn btn-outline-dark btn-lg btn-block" onclick="window.history.back();">
            <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
          </button>
        </div>
        <div class="col-sm-10">
          <a href="<?php echo base_url(); ?>members/project/index" class="btn btn-outline-success  btn-lg  btn-block">View projects list</a>
        </div>
        <?php if($this->session->userdata('org_id') == $project->org_id) {  //สามารถแก้ไขเฉพาะในโรงเรียนเดียวกัน ?>
          <div class="col-sm-10">
            <a href="<?php echo base_url(); ?>members/project/upload_picture/<?php echo $project->id; ?>" class="btn btn-warning btn-lg btn-block">Change picture</a>
          </div>
          <div class="col-sm-10">
            <a href="<?php echo base_url(); ?>members/project/edit/<?php echo $project->id; ?>" class="btn btn-primary btn-lg btn-block">Edit infomation</a>
          </div>
          <div class="col-sm-10">
            <a href="<?php echo base_url(); ?>members/project/required/<?php echo $project->id; ?>" class="btn btn-success btn-lg btn-block">Project needs</a>
          </div>
        <?php } ?>
      </div>
    </div>
    <hr class="featurette-divider">
    <div class="col-sm-10">
      <h3 class="taxt-muted">Project information</h3>
      <div class="card">
        <div class="card-body">
          <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
              <strong><?php echo $this->lang->line('login_warn'); ?></strong> <?php echo $error; ?>
            </div>
          <?php } ?>
          <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
          <?php echo form_open(''); ?>
          <form>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputName"  class="control-label"><b>Project name*</b></label>
                  <input type="text"  name="name"  class="form-control" value="<?php echo $project->name ?>" required="required" readonly>
                  <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  <?php echo form_error('name','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputConcept"  class="control-label"><b>Concept*</b></label>
                  <textarea class="form-control" name="concept" id="about" rows="10" required="required" readonly><?php echo $project->concept ?></textarea>
                  <?php echo form_error('concept','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  <?php echo form_error('concept','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputObjective"  class="control-label"><b>Objective*</b> (less than 255)</label>
                  <textarea class="form-control" name="objective" id="objective" rows="3" required="required" readonly><?php echo $project->objective ?></textarea>
                  <?php echo form_error('objective','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                  <?php echo form_error('objective','<p class="text-danger">','</p>'); //แสดงคำอธิคำอธิบายเกี่ยวกับข้อมูล?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title"><b>category*</b></label>
                  <select class="form-control" name="category_id" required="required" readonly>
                    <?php
                    foreach($categorys as $category) {
                      if($category->id == $project->category_id){ ?>
                        <option value="<?=$category->id?>" selected><?=$category->name?></option>
                      <?php } ?>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="title"><b>Style</b></label>
                  <select class="form-control" name="style_id" required="required" readonly>
                    <?php
                    foreach($styles as $style) {
                      if($style->id == $project->style_id){ ?>
                        <option value="<?=$style->id?>" selected><?=$style->name?></option>
                      <?php } ?>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="select" class="control-label"><b>Organization</b></label>
                  <select class="form-control" name="org_id" required="required" readonly>
                    <?php
                    foreach($orgs as $org) {
                      if($org->id == $project->org_id){ ?>
                        <option value="<?=$org->id?>" selected><?=$org->name?></option>
                      <?php } ?>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <h3 class="text-primary"><b>Students</b></h3>
                <?php $div = explode(",",$project->students); //แยก student id ออกมา แช่น 2,5,12 => 2 5 12 ?>
                <?php foreach($users as $user) { ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-check">
                        <?php if($user->occ_id == 1){ // 1: Students ดูค่าในตาราง tb_occ_type ?>
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="students[]" value="<?php echo $user->id; ?>"
                            <?php for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
                              if($user->id == $div[$i]) echo 'checked';
                            } ?> disabled> <?php echo $user->firstname.' '.$user->lastname; ?>
                          </label>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <div class="col-md-6">
                <h3 class="text-primary"><b>Teachers</b></h3>
                <?php $div = explode(",",$project->teachers); //แยก teacher id ออกมา แช่น 2,5,12 => 2 5 12 ?>
                <?php foreach($users as $user) { ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-check">
                        <?php if(($user->occ_id == 2)||($user->occ_id == 3)){ // 2: Teacher 3:profressor ดูค่าในตาราง tb_occ_type ?>
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="teachers[]" value="<?php echo $user->id; ?>"
                            <?php for($i=0;$i<count($div);$i++){      //วนลูปเพื่อกำหนด checked
                              if($user->id == $div[$i]) echo 'checked';
                            } ?> disabled> <?php echo $user->firstname.' '.$user->lastname; ?>
                          </label>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
              <input type="hidden" name="update_name" value="<?php echo $this->session->userdata('firstname'); ?>">
            </form>
            <?php echo form_close(); ?>
            <div class="table-responsive">
              <h3 class="text-success"><b>Documents</b></h3>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Document</th>
                    <th>Downloaded(times)</th>
                    <th>Last update</th>
                    <th>files</th>
                    <th>Upload(Owner only)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Abstract (.docx)</td>
                    <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-abstract-'.$project->id.'.docx'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-abstract-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-abstract-'.$project->id.'.docx'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file('tjsif2019-project-abstract-'.$project->id.'.docx') == null) { ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-abstract-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success disabled"><i class='far fa-file-word'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-abstract-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success"><i class='far fa-file-word'></i> Download</a>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if(($project->org_id == $this->session->userdata('org_id')) && ($this->Site_model->check_abstract_deadline($this->System_model->get_date()) > 0))  { ?>
                        <a href="<?php echo base_url(); ?>members/project/upload_file/<?php echo $project->id; ?>/tjsif2019-project-abstract-<?php echo $project->id.'.docx'; ?>" class="btn btn-outline-primary"><i class='fas fa-cloud-upload-alt'></i> Upload</a>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Abstract (.pdf)</td>
                    <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-abstract-'.$project->id.'.pdf'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-abstract-'.$project->id.'.pdf'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-abstract-'.$project->id.'.pdf'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file('tjsif2019-project-abstract-'.$project->id.'.pdf') == null) { ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-abstract-<?php echo $project->id.'.pdf'; ?>" target="_blank" class="btn btn-outline-success disabled"><i class='far fa-file-pdf'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-abstract-<?php echo $project->id.'.pdf'; ?>" target="_blank" class="btn btn-outline-success"><i class='far fa-file-pdf'></i> Download</a>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if(($project->org_id == $this->session->userdata('org_id')) && ($this->Site_model->check_abstract_deadline($this->System_model->get_date()) > 0)) { ?>
                        <a href="<?php echo base_url(); ?>members/project/upload_file/<?php echo $project->id; ?>/tjsif2019-project-abstract-<?php echo $project->id.'.pdf'; ?>" class="btn btn-outline-primary"><i class='fas fa-cloud-upload-alt'></i> Upload</a>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Full paper (.docx)</td>
                    <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-fullpaper-'.$project->id.'.docx'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-fullpaper-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-fullpaper-'.$project->id.'.docx'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file('tjsif2019-project-fullpaper-'.$project->id.'.docx') == null) { ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success disabled"><i class='far fa-file-word'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success"><i class='far fa-file-word'></i> Download</a>
                      <?php }?>
                    </td>
                    <td>
                      <?php if(($project->org_id == $this->session->userdata('org_id')) && ($this->Site_model->check_fullpaper_deadline($this->System_model->get_date()) > 0)) { ?>
                        <a href="<?php echo base_url(); ?>members/project/upload_file/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-<?php echo $project->id.'.docx'; ?>" class="btn btn-outline-primary"><i class='fas fa-cloud-upload-alt'></i> Upload</a>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Full paper (.pdf)</td>
                    <td><?php echo $this->Project_model->fetch_file_download('tjsif2019-project-fullpaper-'.$project->id.'.pdf'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update('tjsif2019-project-fullpaper-'.$project->id.'.pdf'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_name('tjsif2019-project-fullpaper-'.$project->id.'.pdf'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file('tjsif2019-project-fullpaper-'.$project->id.'.pdf') == null) { ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-<?php echo $project->id.'.pdf'; ?>" target="_blank" class="btn btn-outline-success disabled"><i class='far fa-file-pdf'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>members/project/download/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-<?php echo $project->id.'.pdf'; ?>" target="_blank" class="btn btn-outline-success"><i class='far fa-file-pdf'></i> Download</a>
                      <?php }?>
                    </td>
                    <td>
                      <?php if(($project->org_id == $this->session->userdata('org_id')) && ($this->Site_model->check_fullpaper_deadline($this->System_model->get_date()) > 0)) { ?>
                        <a href="<?php echo base_url(); ?>members/project/upload_file/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-<?php echo $project->id.'.pdf'; ?>" class="btn btn-outline-primary"><i class='fas fa-cloud-upload-alt'></i> Upload</a>
                      <?php } ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <?php
            $comment_num =$this->Project_model->check_comment($project->id);
            if(($project->org_id == $this->session->userdata('org_id')) && (count($comment_num) > 0)){ ?>
            <div class="table-responsive">
              <h3 class="text-warning"><i class='far fa-edit'></i> <b>Master's opinion</b></h3>
              <p>To complete project documentation You can download the document and edit it and then upload it back to the system. </p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Document</th>
                    <th>Downloaded(times)</th>
                    <th>Last update</th>
                    <th>files</th>
                    <th>Upload(Owner only)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Abstract comment (.docx)</td>
                    <td><?php echo $this->Project_model->fetch_file_download_comment('tjsif2019-project-abstract-comment-'.$project->id.'.docx'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update_comment('tjsif2019-project-abstract-comment-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_comment_name('tjsif2019-project-abstract-comment-'.$project->id.'.docx'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file_comment('tjsif2019-project-abstract-comment-'.$project->id.'.docx') == null) { ?>
                        <a href="<?php echo base_url(); ?>members/project/download_comment/<?php echo $project->id; ?>/tjsif2019-project-abstract-comment-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-warning disabled"><i class='far fa-file-word'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>members/project/download_comment/<?php echo $project->id; ?>/tjsif2019-project-abstract-comment-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-warning"><i class='far fa-file-word'></i> Download</a>
                      <?php } ?>
                    </td>
                    <td>
                        <?php if($project->org_id == $this->session->userdata('org_id')) { ?>
                        <a href="<?php echo base_url(); ?>members/project/upload_file_comment/<?php echo $project->id; ?>/tjsif2019-project-abstract-edited-<?php echo $project->id.'.docx'; ?>" class="btn btn-outline-info"><i class='fas fa-cloud-upload-alt'></i> Upload the edited file.</a>
                        <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Full paper comment (.docx)</td>
                    <td><?php echo $this->Project_model->fetch_file_download_comment('tjsif2019-project-fullpaper-comment-'.$project->id.'.docx'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update_comment('tjsif2019-project-fullpaper-comment-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_comment_name('tjsif2019-project-fullpaper-comment-'.$project->id.'.docx'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file_comment('tjsif2019-project-fullpaper-comment-'.$project->id.'.docx') == null) { ?>
                        <a href="<?php echo base_url(); ?>members/project/download_comment/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-comment-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-warning disabled"><i class='far fa-file-word'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>members/project/download_comment/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-comment-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-warning"><i class='far fa-file-word'></i> Download</a>
                      <?php } ?>
                    </td>
                    <td>
                      <?php if($project->org_id == $this->session->userdata('org_id')) { ?>
                        <a href="<?php echo base_url(); ?>members/project/upload_file_comment/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-edited-<?php echo $project->id.'.docx'; ?>" class="btn btn-outline-info"><i class='fas fa-cloud-upload-alt'></i> Upload the edited file.</a>
                        <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Abstract edited (.docx)</td>
                    <td><?php echo $this->Project_model->fetch_file_download_comment('tjsif2019-project-abstract-edited-'.$project->id.'.docx'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update_comment('tjsif2019-project-abstract-edited-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_comment_name('tjsif2019-project-abstract-edited-'.$project->id.'.docx'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file_comment('tjsif2019-project-abstract-edited-'.$project->id.'.docx') == null) { ?>
                        <a href="<?php echo base_url(); ?>members/project/download_comment/<?php echo $project->id; ?>/tjsif2019-project-abstract-edited-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success disabled"><i class='far fa-file-word'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>members/project/download_comment/<?php echo $project->id; ?>/tjsif2019-project-abstract-edited-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success"><i class='far fa-file-word'></i> Download</a>
                      <?php } ?>
                    </td>
                    <td>
                    </td>
                  </tr>
                  <tr>
                    <td>Full paper edited (.docx)</td>
                    <td><?php echo $this->Project_model->fetch_file_download_comment('tjsif2019-project-fullpaper-edited-'.$project->id.'.docx'); //update time ์?></td>
                    <td><?php echo $this->Project_model->fetch_file_update_comment('tjsif2019-project-fullpaper-edited-'.$project->id.'.docx'); //update time ์?> by <?php echo $this->Project_model->fetch_file_update_comment_name('tjsif2019-project-fullpaper-edited-'.$project->id.'.docx'); //update time ์?></td>
                    <td>
                      <?php if($this->Project_model->check_file_comment('tjsif2019-project-fullpaper-edited-'.$project->id.'.docx') == null) { ?>
                        <a href="<?php echo base_url(); ?>staff/projects/download_comment/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-edited-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success disabled"><i class='far fa-file-word'></i> Download</a>
                      <?php }else{ ?>
                        <a href="<?php echo base_url(); ?>staff/projects/download_comment/<?php echo $project->id; ?>/tjsif2019-project-fullpaper-edited-<?php echo $project->id.'.docx'; ?>" target="_blank" class="btn btn-outline-success"><i class='far fa-file-word'></i> Download</a>
                      <?php } ?>
                    </td>
                    <td>
                    </td>
                  </tr>
                  </tbody>
              </table>
            </div>
          <?php } //show comment?>

          </div>
        </div>
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
