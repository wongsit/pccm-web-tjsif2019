<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Projects list</h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-9">
      <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
    </div>
    <div class="col-sm-3">
      <a href="<?php echo base_url(); ?>staff/projects/new" class="btn btn-success btn-block"><i class='fas fa-plus'></i> Add Project</a>
      <button type="button" class="btn btn-secondary  btn-block" onclick="window.history.back();">
        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
      </button>
    </div>
  </div>
  <div class="row">
    <h5 class="text-success">Project total: <?php echo count($projects); ?> Subject.</h5>
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
          <?php foreach ($projects as $project) {  ?>
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
