<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $title ?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/icons/favicon.ico">
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>/assets/css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top"  role="navigation">
    <div class="container topnav">
      <a  class="navbar-brand"  href="<?php echo base_url(); ?>">TJSIF-2019</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>
  <br>
  <div class="container col-sm-6">
    <div class="card">
      <div class="card-header"><i class='fas fa-user-check' style='font-size:32px;'></i> <b>TJ-SSF 2019 Register</b></div>
      <div class="card-body">

        <?php echo $this->session->flashdata('msg_info'); //แสดงผลลัพท์จากระบบ ?>
        </div>
    </div>
  </div>
    <br>

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

          <!-- Bootstrap core JavaScript-->
          <script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
          <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          <!-- Core plugin JavaScript-->
          <script src="<?php echo base_url(); ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        </body>
        </html>
