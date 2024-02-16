<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Export</h1>
  <ul class="nav nav-pills">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class='fas fa-filter'></i> Filter</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="<?php echo base_url(); ?>staff/export/filter_members"><i class='fas fa-users'></i> Members</a>
      <a class="dropdown-item" href="<?php echo base_url(); ?>staff/export/filter_projects"><i class='fas fa-drafting-compass'></i> Projects</a>
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
    <h2 class="text-success"><b><i class='fas fa-file-excel'></i> Excel</b></h2>
    <div class="table-responsive">
      <h4 class="text-muted"><i class='fas fa-users'></i> <b>Member list</b></h4>
      <table class="table table-striped">
        <tbody>
        <tr>
          <td><b>The List of all members.</b> (The list of all member registerd.)</td>
          <td></td>
          <td><a href="<?php echo base_url(); ?>staff/export/export_all_members" class="btn btn-warning"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
        </tr>
        <tr>
          <td><b>The List of all members.</b> (The list does not include the the member registerd as Contact person(Not attendee) and Participant(Not attendee))</td>
          <td></td>
          <td><a href="<?php echo base_url(); ?>staff/export/export_members_participant" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
        </tr>
        <tr>
          <td><b>The List of all members.</b> (The list does not include the the member registerd as Contact person (Not attendee) and Observer, and also inactive member)</td>
          <td></td>
          <td><a href="<?php echo base_url(); ?>staff/export/export_members_participant_not_observer" class="btn btn-primary"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
        </tr>
        <tr>
          <td><b>The list of all students.</b> (The list does not include the the member registerd as Contact person(Not attendee) and Participant(Not attendee))</td>
          <td></td>
          <td><a href="<?php echo base_url(); ?>staff/export/export_all_students" class="btn btn-warning"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
        </tr>
        <tr>
          <td><b>The list of all members exclude students.</b> (The list does not include the the member registerd as Contact person(Not attendee) and Participant(Not attendee))</td>
          <td></td>
          <td><a href="<?php echo base_url(); ?>staff/export/export_all_member_not_students" class="btn btn-success"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
        </tr>
        <tr>
          <td><b>The member list of Hackathon game programming.</b></td>
          <td></td>
          <td><a href="<?php echo base_url(); ?>staff/export/export_all_member_hackathon" class="btn btn-danger"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
        </tr>
      </tbody>
    </table>

    <h4 class="text-muted"><i class='fas fa-drafting-compass'></i> <b>Project list</b></h4>
    <table class="table table-striped">
      <tbody>
      <tr>
        <td>The List of all Projects.</td>
        <td></td>
        <td><a href="<?php echo base_url(); ?>staff/export/export_all_projects" class="btn btn-success float-right"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
      </tr>
      <tr>
        <td>The List of all Projects needs.</td>
        <td></td>
        <td><a href="<?php echo base_url(); ?>staff/export/export_project_required" class="btn btn-warning float-right"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
      </tr>
    </tbody>
  </table>

  <h4 class="text-muted"><i class='fas fa-drafting-compass'></i> <b>Organization list</b></h4>
  <table class="table table-striped">
    <tbody>
    <tr>
      <td>The List of all Organization.</td>
      <td></td>
      <td><a href="<?php echo base_url(); ?>staff/export/export_all_Organizations" class="btn btn-primary float-right"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
    </tr>
  </tbody>
</table>

  </div>
<!--
  <h3 class="text-danger"><b><i class='fas fa-file-pdf'></i> pdf</b></h3>
  <div class="table-responsive">
    <p><b>Member list</b> (The list does not include the the member registerd as Contact person (Not attendee) and Observer, and also inactive member)</p>
    <table class="table table-striped">
      <tbody>
      <tr>
        <td>The List of all members.</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>The list of all students.</td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>The list of all members exclude students.</td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <p><b>Project list</b></p>
  <table class="table table-striped">
    <tbody>
    <tr>
      <td>The List of all Project.</td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
    </table>
</div>
-->
</div>

</div>
</div>
