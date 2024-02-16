<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
  <h1 class="text-muted">TJ-SIF 2019 for members</h1>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">
      <div class="row">
        <div class="col-sm-5">
          <h3>Don’t be a stranger</h3>
          <?php $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$user->id.'.jpg');
          if($img_check){ ?>
            <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $user->id.'.jpg'; ?>" class="rounded-circle img-responsive d-block w-100" alt="Cinque Terre">
          <?php }else{ ?>
            <i class='fas fa-user' style='font-size:240px;color:lightblue'></i>
          <?php  } ?>
          <br>
          <a href="<?php echo base_url(); ?>users/profile" class="btn btn-outline-warning">View Profile</a>
          <a href="<?php echo base_url(); ?>members/activity/attendance" class="btn btn-outline-info">Check Attendance</a>
        </div>
        <div class="col-sm-7">
          <div class="card bg-info">
            <div class="card-header  bg-info">What's new</div>
              <ul class="list-group">
                <li class="list-group-item text-left">
                  <a class="nav-link text-info" href="<?php echo base_url(); ?>users/account/download/TJ-SIF2019_Handbook.pdf">
                  <i class='fas fa-book-open' style='font-size:24px;color:pink'></i> TJ-SIF2019 <b>Handbook</b> documents ready for download.
                  </a>
                </li>
                <li class="list-group-item text-left">
                  <a class="nav-link text-warning" href="<?php echo base_url(); ?>members/project">
                  <i class='far fa-edit' style='font-size:24px;color:indigo'></i> A questionnaire to realize the special needs in organizing the project presentation’s location.
                  </a>
                </li>
                <li class="list-group-item text-left">
                  <a class="nav-link text-success" href="<?php echo base_url(); ?>users/profile/fieldtrip">
                  <i class='fas fa-map-marked-alt' style='font-size:24px;color:red'></i> Now you can choose a field trip.
                  </a>
                </li>
                <!--
                <li class="list-group-item text-left">
                  <a class="nav-link text-muted" href="<?php echo base_url(); ?>#Program">
                  <i class='far fa-comment' style='font-size:24px;color:green'></i> Update tentative schedule program.
                  </a>
                </li>
                <li class="list-group-item  text-left">
                  <a class="nav-link text-muted" href="#">
                  <i class='far fa-comment' style='font-size:24px;color:red'></i> TJ-SIF2019 documents templates ready for download.
                  <a>
                </li> -->
                <li class="list-group-item  text-left">
                  <a class="nav-link text-muted" href="https://www.facebook.com/Tj-Sif2019-302566937019347" target="_blank">
                  <i class="fa fa-facebook-square" style="font-size:24px;color:blue"></i>
                   TJ-SIF2019 Official Facebook fanpage opened!
                   </a>
                </li>
                <li class="list-group-item  text-muted">
                  <a class="nav-link text-muted" href="#">
                  <i class='far fa-id-card' style='font-size:24px;color:red'></i> TJ-SIF2019 Open for registration.! Apirl.1,2019
                  </a>
                </li>
              </ul>
          </div>
        </div>
        <div class="col-sm-12">
          <br>
          <h3 class="taxt-muted"><i class='fas fa-map-marked-alt'></i> Field trip</h3>
          <div class="card">
            <div class="card-header">
              Five courses are available!
              <a href="<?php echo base_url(); ?>users/profile/fieldtrip" class="btn btn-warning"><i class='fas fa-map-marked-alt'></i>  Choose fieldtrip</a>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <img src="<?php echo base_url(); ?>assets/images/fieldtrip/thai-lao-bridge.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                  <p class="lead"> <b>Thai-Laos Friendship Bridge Mukdahan</b></p>
                  <p>
                    To study the properties of water in the Mekong River by using various types of sensors such as temperature, pH and the concentration of magnesium ions via application.
                  </p>
                  <hr class="featurette-divider">
                </div>
                  <div class="col-sm-6">
                    <img src="<?php echo base_url(); ?>assets/images/fieldtrip/phatheb.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                    <p class="lead"><b>Phu Pha Thoep National Park</b></p>
                    <p>
                       To study the changes of the crust and the shape of various types of rocks and do activities by using sensors to measure light intensity, humidity, temperature at Phu Pha Thoep National Park.
                  </p>
                  <hr class="featurette-divider">
                </div>
                <div class="col-sm-4">
                  <img src="<?php echo base_url(); ?>assets/images/fieldtrip/3.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                  <p class="lead"><b>Mukdahan Inland Fisheries Station </b></p>
                  <p></p>
                  <hr class="featurette-divider">
                </div>
                <div class="col-sm-4">
                  <img src="<?php echo base_url(); ?>assets/images/fieldtrip/4.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                  <p class="lead"><b>The Queen Sirikit Department of Sericulture</b></p>
                  <p>
                  </p>
                  <hr class="featurette-divider">
                </div>
                <div class="col-sm-4">
                  <img src="<?php echo base_url(); ?>assets/images/fieldtrip/5.jpg" class="float-left  img-responsive d-block w-100" alt="fieldtrip">
                  <p class="lead"><b>Mukdahan Agricultural Research and Development Centre</b></p>
                  <p></p>
                  <hr class="featurette-divider">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <h3 class="taxt-muted">Download</h3>
          <div class="card">
            <div class="card-header">The currently available download is as follows</div>
            <div class="card-body">
              <table class="table table-striped">
              <thead>
                <tr>
                  <th>Documents for project</th>
                  <th>Number of Downloads</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Guidelines for the Poseter Presentation (.pdf)</td>
                  <td><?php echo $this->Users_model->fetch_file_download('tj-sif2019-PosterGuideline.pdf'); //update time ์?></td>
                  <td><a href="<?php echo base_url(); ?>users/account/download/tj-sif2019-PosterGuideline.pdf" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                </tr>
                <tr>
                  <td>Full Paper Sample (.docx)</td>
                  <td><?php echo $this->Users_model->fetch_file_download('tj-sif2019-Full-Paper-Sample.docx'); //update time ์?></td>
                  <td><a href="<?php echo base_url(); ?>users/account/download/tj-sif2019-Full-Paper-Sample.docx" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                </tr>
                <tr>
                  <td>Full Paper Sample (.pdf)</td>
                  <td><?php echo $this->Users_model->fetch_file_download('tj-sif2019-Full-Paper-Sample.pdf'); //update time ์?></td>
                  <td><a href="<?php echo base_url(); ?>users/account/download/tj-sif2019-Full-Paper-Sample.pdf" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                </tr>
                <tr>
                  <td>Abstract Sample Include PCSHS logo and the Event Logo (.pdf)</td>
                  <td><?php echo $this->Users_model->fetch_file_download('tj-sif2019-Abstract-Sample.pdf'); //update time ์?></td>
                  <td><a href="<?php echo base_url(); ?>users/account/download/tj-sif2019-Abstract-Sample.pdf" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                </tr>
                <tr>
                  <td>Abstract Sample Include PCSHS logo and the Event Logo (.docx)</td>
                  <td><?php echo $this->Users_model->fetch_file_download('tj-sif2019-Abstract-Sample.docx'); //update time ์?></td>
                  <td><a href="<?php echo base_url(); ?>users/account/download/tj-sif2019-Abstract-Sample.docx" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
                </tr>
              </tbody>
            </table>

            <table class="table table-striped">
            <thead>
              <tr>
                <th>The others</th>
                <th>Number of Downloads</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>TJ-SIF2019 Program Book (.pdf)</td>
                <td><?php echo $this->Users_model->fetch_file_download('TJ-SIF2019_Handbook.pdf'); //update time ์?></td>
                <td><a href="<?php echo base_url(); ?>users/account/download/TJ-SIF2019_Handbook.pdf" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
              </tr>
              <tr>
                <td>TJ-SIF2019 Official Brochure (.pdf)</td>
                <td><?php echo $this->Users_model->fetch_file_download(''); //update time ์?></td>
                <td><a href="#" class="btn btn-info disabled"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
              </tr>
              <tr>
                <td>The Map of Princess Chulabhorn Science High School (.pdf)</td>
                <td><?php echo $this->Users_model->fetch_file_download('tjsif2019-map.pdf'); //update time ์?></td>
                <td><a href="<?php echo base_url(); ?>users/account/download/tjsif2019-map.pdf" class="btn btn-info"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
              </tr>
              <tr>
                <td>The New Nomitory for Japanese Students and Teachers (.pdf)</td>
                <td><?php echo $this->Users_model->fetch_file_download(''); //update time ์?></td>
                <td><a href="#" class="btn btn-info disabled"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
              </tr>
              <tr>
                <td>TJ-SIF2019 Official Event Poster (.pdf)</td>
                <td><?php echo $this->Users_model->fetch_file_download(''); //update time ์?></td>
                <td><a href="#" class="btn btn-info disabled"><i class='fas fa-cloud-download-alt'></i> Download</a></td>
              </tr>
            </tbody>
          </table>

            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <h3 class="taxt-muted">How to invite a new member</h3>
          <div class="card">
            <div class="card-header">Sending a new invitation</div>
            <div class="card-body">
              <p class="lead">You can invite a new menber from the invitation page.</p>
                <p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  1. Before you send the invitation, you have to check whether the
                  <a href="">organization</a> where the new member will belong to is exist or not. If not please contact to TJ-SIF2019 SECRETARIAT.
                </p>
                <p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  2. Go to the   <mark>invitation</mark> page.</p>
                <p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  3. Enter the <mark>user name</mark> that only used in the invitation mail and email address of the person you would like to invite.</p>
                <p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  4. Click the <a href="<?php echo base_url(); ?>members/member/invite" class="btn btn-success"><i class='fas fa-envelope'></i> Send Invite</a> button to send.</p>
                <p class="text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  5. If you are sending more than one invitation, you can also continue to send it to the other people.</p>
            </div>
          </div>
        </div>
        <!--
        <div class="col-sm-12">
          <h3 class="taxt-muted">Latest posts</h3>
          <div class="card">
            <div class="card-header">Membername Date post</div>
            <div class="card-body">
                Comming zoon....
            </div>
          </div>
        </div>
      -->
      </div>
    </div>
    <div class="col-sm-4">
      <div class="row">
        <div class="col-sm-6">
          <a href="<?php echo base_url(); ?>users/profile" class="btn btn-outline-info btn-block text-left"><i class='far fa-user-circle'></i> Profile</a>
        </div>
        <div class="col-sm-6">
          <a href="<?php echo base_url(); ?>members/project" class="btn btn-outline-info btn-block text-left"><i class='fas fa-drafting-compass'></i> Project</a>
        </div>
        <div class="col-sm-6">
          <a href="<?php echo base_url(); ?>members/activity" class="btn btn-outline-info  btn-block text-left"><i class='fas fa-glass-cheers'></i> Activity</a>
        </div>
        <div class="col-sm-6">
          <a href="<?php echo base_url(); ?>members/member/index" class="btn btn-outline-info  btn-block text-left"><i class='fas fa-users'></i> Member</a>
        </div>
        <div class="col-sm-6">
          <a href="<?php echo base_url(); ?>members/organization/index" class="btn btn-outline-info  btn-block text-left"><i class='fas fa-school'></i> Organization</a>
        </div>
        <div class="col-sm-6">
          <a href="<?php echo base_url(); ?>members/activity/attendance" class="btn btn-outline-info btn-block text-left"><i class='fas fa-calendar-check'></i> Attendance</a>
        </div>
        <div class="col-sm-6">
          <a href="<?php echo base_url(); ?>members/statistic" class="btn btn-outline-info btn-block text-left"><i class='fas fa-poll'></i> Statistic</a>
        </div>
        <div class="col-sm-6">
          <!-- <a href="<?php echo base_url(); ?>members/export/" class="btn btn-outline-info btn-block text-left"><i class='fas fa-file-export'></i> Export</a> -->
        </div>
      </div>
      <br>
      <h3 class="text-muted">Notifications</h3>
      <div class="row">
        <div class="col-sm-12">
          <ul class="list-group">
            <?php foreach ($notifys as $notify) { ?>
            <li class="list-group-item d-flex justify-content-between align-items-left">
              <?php $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$notify->user_id.'_thumb.jpg');
              if($img_check){ ?>
                <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $notify->user_id.'_thumb.jpg'; ?>" class="rounded-circle img-responsive" alt="Cinque Terre" width="60" style="margin:7px">
              <?php }else{ ?>
                <i class='fas fa-user' style='font-size:24px;color:lightgreen'></i>
              <?php  } ?>
              <p><b><?php
              $user = $this->Users_model->fetch_user_data_id($notify->user_id);
              if($user != null){
                echo  $user->firstname.' '.$user->lastname;
              ?></b></p>
              <a href="<?php echo base_url().$notify->link; ?>" class="text-info">
                <p> &nbsp;<?php echo $notify->detail; ?></p>
              </a>
              <?php } ?>
            </li>
          <?php } ?>
          </ul>
        </div>
      </div>
      <a href="#" class="btn btn-light">View all Notifications >></a>
      <div class="fb-page" data-href="https://www.facebook.com/Tj-Sif2019-302566937019347" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Tj-Sif2019-302566937019347" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Tj-Sif2019-302566937019347">Tj-Sif2019</a></blockquote></div>
    </div>
  </div>
  <?php if($introduce_member != null){ ?>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">
      <h1 class="text-warning">Introduce a members</h1>
      <h2 class="text-info">
        <?php
        echo $this->Users_model->fetch_title_name($introduce_member->id);
        echo $introduce_member->firstname.' '.$introduce_member->lastname;
        ?>
      </h2>
      <h3 class="text-muted">
        <?php
        echo $this->Users_model->fetch_occ_type_name($introduce_member->occ_id).' in ';
        echo $this->Users_model->fetch_org_name($introduce_member->org_id);
        ?>
      </h3 class="text-muted">
      <p>
        <?php
        echo '<b>About</b>: '.$introduce_member->about;
        ?>
      </p>
      <a href="<?php echo base_url(); ?>members/member/info/<?php echo $introduce_member->id; ?>" class="btn btn-outline-info">View Details >></a>
    </div>
    <div class="col-sm-4">
      <?php $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$introduce_member->id.'.jpg');
      if($img_check){ ?>
        <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $introduce_member->id.'.jpg'; ?>" class="rounded-circle img-responsive d-block w-100" alt="Cinque Terre">
      <?php }else{ ?>
        <i class='fas fa-user' style='font-size:240px;color:lightblue'></i>
      <?php  } ?>
    </div>
  </div>
  <?php  } ?>
  <?php if($introduce_project != null){ ?>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-4">
      <?php $img_check = file_exists('assets/images/projects/tjsif2019-project-'.$introduce_project->id.'.jpg');
      if($img_check){ ?>
        <img src="<?php echo base_url(); ?>assets/images/projects/tjsif2019-project-<?php echo $introduce_project->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
      <?php }else{ ?>
        <i class='fas fa-drafting-compass' style='font-size:240px;color:lightblue'></i>
      <?php  } ?>
    </div>
    <div class="col-sm-8">
      <h1 class="text-warning">Introduce a Project</h1>
      <h2 class="text-info">
        <?php
        echo $introduce_project->name;
        ?>
      </h2>
      <h3 class="text-muted">
        <?php
        echo $this->Users_model->fetch_org_name($introduce_project->org_id);
        ?>
      </h3>
      <p>
        <?php
        echo '<b>Category</b>: '.$this->Users_model->fetch_category_name($introduce_project->category_id);
        ?>
      </p>
      <p>
        <?php
        echo '<b>Objective</b>: '.$introduce_project->objective;
        ?>
      </p>
      <a href="<?php echo base_url(); ?>members/project/info/<?php echo $introduce_project->id; ?>" class="btn btn-outline-info">View Details >></a>
    </div>
  </div>
<?php  } ?>
<?php if($introduce_org != null){ ?>
  <hr class="featurette-divider">
  <div class="row">
    <div class="col-sm-8">
      <h1 class="text-warning">Introduce a School</h1>
      <h2 class="text-info">
        <?php
        echo $introduce_org->shortname;
        ?>
      </h2>
      <h3 class="text-muted">
        <?php
        echo $introduce_org->name;
        ?>
      </h3>
      <p>
        <?php
        echo '<b>About</b>: '.$introduce_org->about;
        ?>
      </p>
      <a href="<?php echo base_url(); ?>members/organization/info/<?php echo $introduce_org->id; ?>" class="btn btn-outline-info">View Details >></a>
    </div>
    <div class="col-sm-4">
      <?php $img_check = file_exists('assets/images/orgs/tjsif2019-org-'.$introduce_org->id.'.jpg');
      if($img_check){ ?>
        <img src="<?php echo base_url(); ?>assets/images/orgs/tjsif2019-org-<?php echo $introduce_org->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
      <?php }else{ ?>
        <i class='fas fa-school' style='font-size:240px;color:lightblue'></i>
      <?php  } ?>
    </div>
  </div>
  <?php  } ?>
  <hr class="featurette-divider">
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0&appId=801406600198029&autoLogAppEvents=1"></script>
