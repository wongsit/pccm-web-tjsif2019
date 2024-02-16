<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-success"><i class='fas fa-envelope'></i> Send E-mail</h1>
  <hr class="featurette-divider">
  <?php
  $attributes = array('id' => 'sendemail');
  echo form_open('staff/sendemail/send',$attributes);
  ?>
  <form>
  <div class="row">
    <div class="col-sm-9">
      <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
      <div class="row">
        <div class="col-md-12">
          <p>This automatic email delivery system. Will send an email under the name <b>noreply@pccm.ac.th</b> <br/>To communicate information News to members at the event.</p>
          <h3 class="text-muted"><i class='fas fa-file-alt'></i> Email content</h3><br>
          <div class="form-group">
            <label for="inputTitle"  class="control-label"><b>Title</b></label>
            <input type="text" name="email_title" class="form-control" placeholder="Title">
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
          <label for="inputTitle"  class="control-label"><b>Content</b></label>
          <textarea name="content">
            <img class="d-block w-100" src="http://tjsif2019.pccm.ac.th/assets/images/header/header-tjsif2019.png" alt="tjsif2019" align="center" style="height:100px;">
            <br/>
            <h3>Hi, ...</h3>
            <p>content...</p>
            <p></p>
            <p>contact</p>
            <hr/>
            <div class="container" >
              <h3><strong>TJ-SIF 2019 SECRETARIAT</strong></h3>
              <h5>Princess Chulabhorn Science High School Mukdahan&nbsp;<a href="http://pccm.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></h5>
              <h5>281 Moo 6 BangSaiYai Mueng, Mukdahan 49000 Thailand</h5>
              <ul class="fa-ul">
                <li><i class="fa fa-link fa-fw" aria-hidden="true"></i>&nbsp;<a href="http://tjsif2019.pccm.ac.th">http://tjsif2019.pccm.ac.th</a><li>
                  <li><i class="fa fa-facebook-official fa-fw" aria-hidden="true"></i>&nbsp;<a href="https://www.facebook.com/Tj-Sif2019-302566937019347" target="_blank">http://www.facebook.com/tjsif2019/</a><li>
                    <li><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>&nbsp;<a class="linkOverPic" href="mailto:tjsif2019@pccm.ac.th">tjsif2019@pccm.ac.th</a></li>
                    <li><i class="fa fa-phone fa-fw" aria-hidden="true"></i>&nbsp;+669 7302 8092</li>
                    <li><i class="fa fa-fax fa-fw" aria-hidden="true"></i>&nbsp;+66 42 66 0444 #104</li>
                  </ul>
                  <div class="fb-like" data-href="https://www.facebook.com/Tj-Sif2019-302566937019347" data-width="" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
            </div><!-- /.container -->
          </textarea>
          <script src="./assets/tinymce/js/tinymce/tinymce.min.js"></script>
          <script>
          tinymce.init({
              selector: "textarea",theme: "silver",width: 960,height: 480,
              plugins: [
                   "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                   "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                   "table contextmenu directionality emoticons paste textcolor code"
             ],
             toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
             toolbar2: "| link unlink anchor | image media | forecolor backcolor  | print preview code ",
             image_advtab: true ,
             relative_urls:false,
             remove_script_host:false,
             document_base_url:"<?php echo base_url(); ?>"
           });
          </script>
          </div>
          <br/>
        </div>

      </div>
    </div>
    <div class="col-sm-3">
        <?php
        $i=0;
        $user_id = array();
        foreach ($users as $row) {
            $i++;
          ?>
          <input type="hidden" name="users_id[<?php echo $i; ?>]" value="<?php echo $row->id; ?>">
        <?php  } ?>
      <input type="hidden" name="users_amout" value="<?php echo count($users); ?>">
      <input type="hidden" name="update_ip" value="<?php echo $my_ip ?>">
      <input type="hidden" name="update_time" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d H:i:s"); ?>">
      <input type="hidden" name="update_name" value="<?php echo $this->session->userdata('firstname'); ?>">
      <button type="submit" id="send" class="btn btn-primary btn-block"><i class='fas fa-envelope'></i> Send</button>
      <button type="button" class="btn btn-secondary  btn-block" onclick="window.history.back();">
        <i class='fas fa-arrow-alt-circle-left'></i>&nbsp;Back
      </button>
    </div>
  </div>
  </form>
  <br/>

  <div class="row">
    <hr class="featurette-divider">
    <div class="col-sm-12">
    <h3 class="text-muted"><i class='fas fa-users'></i> Filter members for send email:</h3>
      <?php //echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
      <?php
      $attributes = array('id' => 'filter');
      echo form_open('staff/sendemail/filter',$attributes);
      ?>
      <form>
      <div class="form-row">
        <div class="col-md-4">
          <div class="form-group">
            <label for="title"><b>Country</b></label>
            <select class="form-control" name="country">
              <option value="">---Select---</option>
              <?php
              foreach($countrys as $country) {
                ?>
                <?php
                if($country->id == $selected['country']){ ?>
                  <option value="<?=$country->id?>" selected><?=$country->name?></option>
                <?php } else{ ?>
                <option value="<?=$country->id?>"><?=$country->id?>-<?=$country->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="inputGender"><b>Gender</b></label>
            <select class="form-control" id="gender" name="gender">
              <option value="">---Select---</option>
              <?php
              foreach($genders as $gender) {
                ?>
                <?php
                if($gender->id == $selected['gender']){ ?>
                  <option value="<?=$gender->id?>" selected><?=$gender->name?></option>
                <?php } else{ ?>
                <option value="<?=$gender->id?>"><?=$gender->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="title"><b>Title</b></label>
            <select class="form-control" id="title" name="title">
              <option value="">---Select---</option>
              <?php
              foreach($titles as $title) {
                ?>
                <?php
                if($title->id == $selected['title']){ ?>
                  <option value="<?=$title->id?>" selected><?=$title->name?></option>
                <?php } else{ ?>
                <option value="<?=$title->id?>"><?=$title->name?></option>
                <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="select" class="control-label"><b>Type</b></label>
            <select class="form-control" name="type">
              <option value="">---Select---</option>
              <?php
              foreach($types as $type) {
                ?>
                <?php
                if($type->id == $selected['type']){ ?>
                  <option value="<?=$type->id?>" selected><?=$type->name?></option>
                <?php } else{ ?>
                <option value="<?=$type->id?>"><?=$type->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="select" class="control-label"><b>Occupation</b></label>
            <select class="form-control" name="occ_id">
              <option value="">---Select---</option>
              <?php
              foreach($occ_types as $occ_type) {
                ?>
                <?php
                if($occ_type->id == $selected['occ_id']){ ?>
                  <option value="<?=$occ_type->id?>" selected><?=$occ_type->name?></option>
                <?php } else{ ?>
                <option value="<?=$occ_type->id?>"><?=$occ_type->name?></option>
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
        <div class="col-md-4">
          <div class="form-group">
            <label for="select" class="control-label"><b>Food restrictions</b></label>
            <select class="form-control" name="food">
              <option value="">---Select---</option>
              <?php
              foreach($foods as $food) {
                ?>
                <?php
                if($food->id == $selected['food']){ ?>
                  <option value="<?=$food->id?>" selected><?=$food->name?></option>
                <?php } else{ ?>
                <option value="<?=$food->id?>"><?=$food->name?></option>
              <?php }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
          <label for="select" class="control-label"><b>field trip</b></label>
          <select class="form-control" name="fieldtrip">
            <option value="">---Select---</option>
            <option value="0">Not selected yet</option>
            <?php
            foreach($fieldtrips as $fieldtrip) {
              ?>
              <?php
              if($fieldtrip->id == $selected['fieldtrip']){ ?>
                <option value="<?=$fieldtrip->id?>" selected><?=$fieldtrip->name?></option>
              <?php }else{ ?>
                <option value="<?=$fieldtrip->id?>"><?=$fieldtrip->name?></option>
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
          <button type="submit" class="btn btn-warning"><i class='fas fa-filter'></i> Filter</button>
          <a href="<?php echo base_url(); ?>staff/sendemail/clear_filter" class="btn"> Clear</a>
          </div>
        </div>
      </form>
      </div>
      <hr class="featurette-divider">
    </div>
    <div class="col-md-12">
    <h1 class="text-muted"><i class='fas fa-list'></i> Members list from filter.</h1>
    <label><b>Number of people : <?php echo count($users); ?></b></label>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>school/organization</th>
            <th>occupation</th>
            <th>Type</th>
            <th>email</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          foreach ($users as $row) {
              $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><a href="<?php echo base_url(); ?>staff/profile/index/<?php echo $row->id; ?>" class="lead text-success" target="_blank"><?php echo $row->firstname ?></a></td>
              <td><?php echo $this->Users_model->fetch_org_name($row->org_id); ?></td>
              <td><?php echo $this->Users_model->fetch_occ_type_name($row->occ_id); ?></td>
              <td><?php echo $this->Users_model->fetch_people_type_name($row->type); ?></td>
              <td><?php echo $row->email; ?></td>
            </tr>
          <?php   } ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
