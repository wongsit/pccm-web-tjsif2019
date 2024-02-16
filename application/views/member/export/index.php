<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">Export</h1>
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
      <p><b>Member list</b> (The list does not include the the member registerd as Contact person (Not attendee) and Observer, and also inactive member)</p>
      <table class="table table-striped">
        <tbody>
        <tr>
          <td>The List of all members.</td>
          <td></td>
          <td><a href="<?php echo base_url(); ?>members/export/export_all_members" class="btn btn-success"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
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
        <td>The List of all Projects.</td>
        <td></td>
        <td><a href="<?php echo base_url(); ?>members/export/export_all_projects" class="btn btn-success"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
      </tr>
    </tbody>
  </table>

  </div>

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

</div>

</div>
</div>
