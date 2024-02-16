<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
      <img class="d-block w-100" src="<?php echo base_url(); ?>assets/images/header/header-tjsif2019.jpg" alt="tjsif2019" align="center" style="height:150px;">
    <?php }else{ ?>
      <img class="d-block w-100"  src="<?php echo base_url(); ?>assets/images/header/logo-tj2019.jpg" alt="tjsif2019" align="center">
    <?php } ?>
  </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top"  role="navigation">
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
          <a class="nav-link" href="#schedule">Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Program">Program</a>
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
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <!-- <a class="dropdown-item" href="#">Settings</a> -->
            <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
            <div class="dropdown-divider"></div>
            <?php if($this->session->userdata('username') == null){ ?>
              <a class="dropdown-item" href="<?php echo base_url(); ?>users/account/login"><?php echo $this->lang->line('login'); //เข้าสู่ระบบ ?></a>
            <?php }else{ ?>
              <a class="dropdown-item" href="<?php echo base_url(); ?>users/profile"><i class="far fa-user-circle"></i> <?php echo $this->session->userdata('firstname')." ".$this->session->userdata('lastname'); //ข้อมูลผู้ใช้ ?></a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><?php echo $this->lang->line('logout'); //ออกจากระบบ ?></a>
            <?php } ?>
          </div>
        </li>
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

<a  name="howtojoin"></a>
<div class="content-section-b">
  <?php $this->load->view('home/howtojoin'); ?>


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

<!-- /.content-section-a -->
<a name="PCSHSM"></a>
<div class="content-section-b">
  <?php $this->load->view('home/pccm'); ?>
</div>


<!-- /.content-section-b -->
<div class="content-section-a">
  <?php $this->load->view('home/aroundhere'); ?>
</div>
