<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="<?php echo base_url(); ?>users/account/index"><?php echo $this->lang->line('dashboard'); ?></a>
  </li>
  <li class="breadcrumb-item active"><?php echo $this->lang->line('profile'); ?></li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Data Table Example</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>PID</th>
            <th>name</th>
            <th>surname</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>PID</th>
            <th>name</th>
            <th>surname</th>
          </tr>
        </tfoot>
        <tbody>
          <?php foreach ($users as $user) { ?>
          <tr>
            <td><?php echo $user->pid; ?></td>
            <td><?php echo $user->fname; ?></td>
            <td><?php echo $user->lname; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
