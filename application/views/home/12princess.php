<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <img class="img-responsive  d-block w-100" src="<?php echo base_url(); ?>assets/images/home/pcshs-en.jpg" alt="cshs">
    </div>
    <div class="col-sm-9">
      <!--<hr class="section-heading-spacer">-->
      <div class="clearfix"></div>
      <h2 class="text-success"><strong>12 Princess Chulabhorn Science High Schools </strong></h2>

      <p class="lead">Twelve Princess Chulabhorn Science High Schools (PCSHS) were established in honor of Her Royal Highness Princess Chulabhorn to commemorate her 36th birthday in 1993. Prof. Dr. Her Royal Highness Princess Chulabhorn is the youngest daughter of His Late Majesty King Bhumibol Adulyadej and Queen Sirikit of Thailand.</p><p class="lead">She has been an instructor in Chemistry at Mahidol University since 1985. She is also a member of the President's Council of the University of Tokyo.</p>

      <p class="lead">Being Thailand's leading Super Science High Schools around the country, only students with outstanding academic achievements in Mathematics and Science are selected to study at PCSHS. Not only do they utilize specialized and intensive curricula in mathematics and science emphasizing on research activities, but also they have developed academic cooperation with twelve Super Science High Schools (SSHs) in Japan. The cooperation has included online communication and students/teachers exchange, which led to collaborative researches.</p>

      <p class="lead"><strong>The TJ-SIF 2019 will take a big step towards the collaborative learning and teaching,</strong> and thus building closer and stronger collaboration in gifted education in Mathematics and Science between the two countries.</p>
    </div>

    <div class="col-lg-4">

      <div class="panel-body">
        <p class="lead text-right text-success"><strong>12 PCSHS Link</strong></p>
        <p class="text-right">PCSHS Chiangrai&nbsp;&nbsp;<a href="http://www.pcccr.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Phitsanulok&nbsp;&nbsp;<a href="http://www.pccpl.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Lopburi&nbsp;&nbsp;<a href="http://www.pccl.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Loei&nbsp;&nbsp;<a href="http://www.pccloei.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Mukdahan&nbsp;&nbsp;<a href="http://www.pccm.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Burirum&nbsp;&nbsp;<a href="http://pccbr.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Phathum Thani&nbsp;&nbsp;<a href="http://www.pccp.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Chonburi&nbsp;&nbsp;<a href="http://www.pccchon.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Phetchaburi&nbsp;&nbsp;<a href="http://www.pccphet.com/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Nakhon Si Thammarat&nbsp;&nbsp;<a href="http://www.pccnst.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Trang&nbsp;&nbsp;<a href="http://www.pcctrg.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
        <p class="text-right">PCSHS Satun&nbsp;&nbsp;<a href="http://www.pccst.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></p>
      </div>


    </div>
    <div class="col-lg-8">
      <p>&nbsp;</p>
      <img class="img-responsive  d-block w-100" src="<?php echo base_url(); ?>assets/images/home/thailand_japan_map.jpg" />
    </div>
  </div>
  <?php if($introduce_pcshs != null){ ?>
  <div class="row">
    <div class="col-sm-8">
      <hr class="featurette-divider">
      <h1 class="text-warning">Introduce a School</h1>
      <h2 class="text-info">
        <?php
        echo $introduce_pcshs->shortname;
        ?>
      </h2>
      <h3 class="text-muted">
        <?php
        echo $introduce_pcshs->name;
        ?>
      </h3>
      <p>
        <?php
        echo '<b>About</b>: '.$introduce_pcshs->about;
        ?>
      </p>
    </div>
    <div class="col-sm-4">
      <?php $img_check = file_exists('assets/images/orgs/tjsif2019-org-'.$introduce_pcshs->id.'.jpg');
      if($img_check){ ?>
        <img src="<?php echo base_url(); ?>assets/images/orgs/tjsif2019-org-<?php echo $introduce_pcshs->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
      <?php }else{ ?>
        <i class='fas fa-school' style='font-size:240px;color:lightblue'></i>
      <?php  } ?>
    </div>
  </div>
  <?php  } ?>
</div>
