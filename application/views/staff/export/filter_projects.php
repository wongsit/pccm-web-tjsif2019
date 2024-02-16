<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-success"><i class='fas fa-drafting-compass'></i> <?php echo $title; ?></h1>
  <hr class="featurette-divider">
  <div class="row">
    <hr class="featurette-divider">
    <div class="col-sm-12">
    <h3 class="text-muted"><i class='fas fa-filter'></i> Filter projects</h3>
      <?php //echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
      <?php
      $attributes = array('id' => 'filter');
      echo form_open('staff/export/filter_projects',$attributes);
      ?>
      <form>
      <div class="form-row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="title"><b>Category</b></label>
            <select class="form-control" name="category_id">
              <option value="">---Select---</option>
              <?php
              foreach($categorys as $category) {
                ?>
                <?php
                if($category->id == $selected['category_id']){ ?>
                  <option value="<?=$category->id?>" selected><?=$category->name?></option>
                <?php } else{ ?>
                <option value="<?=$category->id?>"><?=$category->id?>-<?=$category->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="inputGender"><b>Style</b></label>
            <select class="form-control" name="style_id">
              <option value="">---Select---</option>
              <?php
              foreach($styles as $style) {
                ?>
                <?php
                if($style->id == $selected['style_id']){ ?>
                  <option value="<?=$style->id?>" selected><?=$style->name?></option>
                <?php } else{ ?>
                <option value="<?=$style->id?>"><?=$style->name?></option>
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
          <a href="<?php echo base_url(); ?>staff/export/clear_filter_projects" class="btn"> Clear</a>
          </div>
        </div>
      </form>
      </div>
      <hr class="featurette-divider">
    </div>
    <div class="col-md-12">
    <h1 class="text-muted"><i class='fas fa-list'></i> Projects list from filter.</h1>
    <?php
    $attributes = array('id' => 'filter');
    if(isset($selected)){
    $hidden = array(
      'id' => 'download',
      'category_id' => $selected['category_id'],
      'style_id' => $selected['style_id'],
      'org_id' => $selected['org_id'],
      'active' => $selected['active']
    );
  }else{
    $hidden = '';
  }
    echo form_open('staff/export/export_filter_projects',$attributes,$hidden);
    ?>
    <form>
    <p class="float-right">
      <button type="submit" id="send" class="btn btn-primary btn-block"><i class='fas fa-cloud-download-alt'></i> Download</button>
    </p>
  </form>
  <?php echo form_close(); ?>
    <label><b>Number of projects : <?php echo count($projects); ?></b></label>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Catalog</th>
            <th>Style</th>
            <th>School</th>
            <th>Active</th>
            <th>Last update</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          foreach ($projects as $project) {
              $i++;
            ?>
            <tr>
              <td>
                <?php $img_check = file_exists('assets/images/projects/tjsif2019-project-'.$project->id.'_thumb.jpg');
                if($img_check){ ?>
                  <a href="<?php echo base_url(); ?>staff/projects/info/<?php echo $project->id; ?>">
                    <img src="<?php echo base_url(); ?>assets/images/projects/tjsif2019-project-<?php echo $project->id.'_thumb.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
                  </a>
                <?php }else{ ?>
                  <i class='fas fa-drafting-compass' style='font-size:120px;color:lightblue'></i>
                <?php  } ?>
              </td>
              <td><a href="<?php echo base_url(); ?>staff/projects/info/<?php echo $project->id; ?>" class="lead text-success"><?php echo $project->name ?></a></td>
              <td><?php echo $this->Project_model->fetch_project_category_name($project->category_id); ?></td>
              <td><?php echo $this->Project_model->fetch_project_style_name($project->style_id); ?></td>
              <td><?php echo $this->Org_model->fetch_org_name($project->org_id); ?></td>
              <td>
                <?php if($project->active) { ?>
                  <i class='fas fa-check' style='font-size:24px;color:green'></i></span>
                <?php }else{ ?>
                  <i class='far fa-hourglass' style='font-size:24px;color:red'></i></span>
                <?php } ?>
              </td>
              <td><?php echo $project->update_time.' by '.$project->update_name ?></td>
            </tr>
          <?php   } ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
