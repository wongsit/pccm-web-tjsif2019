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

  <!-- Navigation -->
  <nav class="navbar navbar-expand-sm bg-info navbar-dark sticky-top"  role="navigation">
    <div class="container topnav">
      <a  class="navbar-brand"  href="<?php echo base_url(); //หน้าแรก ?> ">TJSIF-2019</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>
  <!-- Header -->
  <div class="content-section-a">
    <?php
    //PAGE--------------------------------------------------------------------
    $this->load->view($page);
    ?>
  </div>
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


    </body>
    </html>

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
