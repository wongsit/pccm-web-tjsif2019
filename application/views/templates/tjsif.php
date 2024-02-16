<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Thailand-Japan Student ICT Fair 2019">
  <meta name="author" content="Putthapond Inorn">
  <meta name="keyword" content="tjsif2019, tj-sif2019, tj, thailand-japan, ictfair,math, phy, chem, ไซแฟร์">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icons/favicon.ico">
  <title><?php echo $title ?> | TJ-SIF2019</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">


  <!-- Respomsive slider -->
  <link href="<?php echo base_url(); ?>assets/css/responsive-slider.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/landing-page.css" rel="stylesheet">
  <!-- Font Awesome 5 icons form w3schools.com-->
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha256-U5ZEeKfGNOja007MMD3YBI0A3OSZOQbeG6z2f2Y0hu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
  <style>
  /*
  thank https://stackoverflow.com/questions/2570972/css-font-border
  */
  .linkOverPic {
    text-shadow:
    -2px  2px white,-1px  2px white, 0px  2px white, 1px  2px white, 2px  2px white,
    -2px  1px white,-1px  1px white, 0px  1px white, 1px  1px white, 2px  1px white,
    -2px  0px white,-1px  0px white,                 1px  0px white, 2px  0px white,
    -2px -1px white,-1px -1px white, 0px -1px white, 1px -1px white, 2px -1px white,
    -2px -2px white,-1px -2px white, 0px -2px white, 1px -2px white, 2px -2px white;
  }
  </style>

  <style>
  #myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    border: none;
    outline: none;
    background-color: red;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 10px;
  }

  #myBtn:hover {
    background-color: #555;
  }
  </style>

</head>
<body>
  <button onclick="topFunction()" id="myBtn" title="Go to top"><span class="glyphicon glyphicon-triangle-top"></span> Top</button>
  <div class="content-section-a ">
    <div  id="header-tj"  class="container container-fuild">
      <?php
      //ตรวจสอบสถานะของอุปกรณ์
      $this->load->view('Mobile_Detect');
      $detect = new Mobile_Detect;
      $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
      //ถ้าเป็น Phone หรือ Tablet ให้ไปที่  http://www.pccm.ac.th/labtop
      if($deviceType=='computer'){	?>
        <img class="d-block w-100" src="<?php echo base_url(); ?>assets/images/header/header-tjsif2019.png" alt="tjsif2019" align="center" style="height:150px;">
      <?php }else{ ?>
        <img class="d-block w-100"  src="<?php echo base_url(); ?>assets/images/header/logo-tj2019.png" alt="tjsif2019" align="center">
      <?php } ?>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top" role="navigation">
    <div class="container topnav">
      <a  class="navbar-brand"  href="#tjsif2019">TJSIF-2019</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a  class="nav-link" href="#pcshs">PCSHS</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="#ssh">SSH</a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" href="#kosen">KOSEN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#schedule">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#Program">Program</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#project">Project</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="#howtojoin">How to join</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="#PCSHSM">PCSHSM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="#contact">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-right">
          <li class="nav-item dropdown no-arrow">
            <?php if($this->session->userdata('username')){ ?>
              <a class="nav-link" href="<?php echo base_url(); ?>users/account/index"><?php echo $this->lang->line('member'); //ผู้ใช้ ?></a>
            <?php } ?>
          </li>
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-globe fa-fw" title="Select Language"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="<?php echo base_url(); ?>welcome/switchLang/english"><?php echo $this->lang->line('EN'); //English ?></a>
            </div>
          </li>
          <?php if($this->session->userdata('username') != null){ ?>
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <!-- <a class="dropdown-item" href="#">Settings</a> -->
              <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
              <div class="dropdown-divider"></div>
              <?php if($this->session->userdata('username') == null){ ?>
                <a class="dropdown-item" href="<?php echo base_url(); ?>users/account/login"><i class='fas fa-lock'></i><?php echo $this->lang->line('login'); //เข้าสู่ระบบ ?></a>
              <?php }else{ ?>
                <a class="dropdown-item" href="<?php echo base_url(); ?>users/profile">
                  <?php
                  $img_check = file_exists('assets/images/users/tjsif2019-profile-'.$this->session->userdata('id').'_thumb.jpg');
                    if($img_check){ ?>
                      <img src="<?php echo base_url(); ?>assets/images/users/tjsif2019-profile-<?php echo $this->session->userdata('id').'_thumb.jpg'; ?>" class="rounded-circle float-left" width="24" alt="Cinque Terre">
                  <?php }else{ ?>
                      <i class='fas fa-user-circle' style='font-size:24px;color:lightblue'></i>
                  <?php  } ?>
                <?php echo ' '.$this->session->userdata('firstname')." ".$this->session->userdata('lastname'); //ข้อมูลผู้ใช้ ?>
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class='fas fa-lock-open'></i>
                  <?php echo $this->lang->line('logout'); //ออกจากระบบ ?>
                </a>
              <?php } ?>
            </div>
          </li>
          <?php } ?>
          <?php if($this->session->userdata('username') == null){ ?>
            <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="<?php echo base_url(); ?>users/account/login"><?php echo $this->lang->line('login'); //เข้าสู่ระบบ ?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>
  <!-- Header -->

  <a name="about"></a>
  <div class="container">
    <?php $this->load->view('home/classic'); ?>
  </div>
  <!-- /.intro-header -->
  <!-- Page Content -->
  <a  name="review"></a>
  <div class="content-section-b">
    <?php $this->load->view('home/review'); ?>
  </div>

  <a  name="tjsif2019"></a>
  <div class="content-section-a">
    <?php $this->load->view('home/tjsif2019'); ?>
  </div>
  <!-- /.content-section-b -->

  <a  name="schedule"></a>
  <div class="content-section-b">
    <?php  $this->load->view('home/schedule'); ?>
  </div>
  <!-- /.content-section-a -->

  <a name="Program"></a>
  <div class="content-section-a">
    <?php $this->load->view('home/program'); ?>
  </div>

<!-- /.content-section-a -->
  <a  name="project"></a>
  <div class="content-section-b">
    <?php $this->load->view('home/project'); ?>
  </div>

  <!-- /.content-section-b -->
  <a  name="fieldtrip"></a>
  <div class="content-section-a">
    <?php  $this->load->view('home/fieldtrip'); ?>
  </div>

  <a  name="pcshs"></a>
  <div class="content-section-b">
    <?php $this->load->view('home/12princess'); ?>
  </div>

  <a name="ssh" ></a>
  <div class="content-section-a">
    <?php $this->load->view('home/ssh'); ?>
  </div>

  <a name="kosen" ></a>
  <div class="content-section-b">
    <?php $this->load->view('home/kosen'); ?>
  </div>

  <!-- /.content-section-a -->
  <a name="PCSHSM"></a>
  <div class="content-section-a">
    <?php $this->load->view('home/pccm'); ?>
  </div>

  <!-- /.content-section-b -->
  <div class="content-section-b">
    <?php $this->load->view('home/aroundhere'); ?>
  </div>

  <a  name="howtojoin"></a>
  <div class="content-section-a">
    <?php $this->load->view('home/howtojoin'); ?>
  </div>

  <a  name="Cooperation"></a>
  <div class="content-section-b">
    <?php $this->load->view('home/cooperation'); ?>
  </div>

  <a  name="contact"></a>
  <div class="jumbotron text-left" style="margin-bottom:0">
    <div class="container" >
      <h2><strong>TJ-SIF 2019 SECRETARIAT</strong></h2>
      <h3>Princess Chulabhorn Science High School Mukdahan&nbsp;<a href="http://pccm.ac.th/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></h3>
      <h4>281 Moo 6 BangSaiYai Mueng, Mukdahan 49000 Thailand</h4>
      <ul class="fa-ul">
        <li><i class="fa fa-link fa-fw" aria-hidden="true"></i>&nbsp;<a href="http://tjsif2019.pccm.ac.th">http://tjsif2019.pccm.ac.th</a><li>
          <li><i class="fa fa-facebook-official fa-fw" aria-hidden="true"></i>&nbsp;<a href="https://www.facebook.com/Tj-Sif2019-302566937019347" target="_blank">http://www.facebook.com/tjsif2019/</a><li>
            <li><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>&nbsp;<a class="linkOverPic" href="mailto:tjsif2019@pccm.ac.th">tjsif2019@pccm.ac.th</a></li>
            <li><i class="fa fa-phone fa-fw" aria-hidden="true"></i>&nbsp;+669 7302 8092</li>
            <li><i class="fa fa-fax fa-fw" aria-hidden="true"></i>&nbsp;+66 42 66 0444 #104</li>
          </ul>
          <div class="fb-like" data-href="https://www.facebook.com/Tj-Sif2019-302566937019347" data-width="220" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
        </div><!-- /.container -->
      </div>
      <!-- Footer -->
      <footer class="site-footer">
        <div class="text-center">
          2019 &copy; Thailand - Japan Student ICT Fair 2019
          <i class="fa fa-bar-chart" aria-hidden="true"></i>
          <?php //include './include/counter.php'; ?>
        </div>
      </footer>

      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v4.0&appId=801406600198029&autoLogAppEvents=1"></script>


      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?php echo base_url(); ?>users/account/logout">Logout</a>
            </div>
          </div>
        </div>
      </div>

    </body>
    </html>
    <?php
    //เช็คกับกำหนดการปิดลงทะเบียน
    if(($this->Site_model->fetch_close_register(1) == $this->System_model->get_date()) && $this->session->userdata('remind')==null){   //ถ้าไม่เกินกำหนด
    ?>
    <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Remind</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <h5 class="text-danger">Today (<?php echo $this->Site_model->fetch_close_register(1); ?>) close at registration<h5><p class="text-primary"> The system will close registration today. <b>Please complete the registration before midnight.</b> Thailand time </h5>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#myModal').modal('show');
        });
    </script>
  <?php  $this->session->set_userdata(array('remind'=>'true')); } ?>

    <script>
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        document.getElementById("myBtn").style.display = "block";
        //  $("#header-tj").hide(250);
      } else {
        document.getElementById("myBtn").style.display = "none";
        //   $("#header-tj").show(250);

      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
