<?php
$title = 'Home';
require "./include/header.php";
?>
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
 <div class="container">
   <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="#tjsif2019">TJSIF-2019</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                   <li>
                        <a href="#pcshs">PCSHS</a>
                    </li>
                    <li>
                        <a href="#ssh">SSH</a>
                    </li>
                    <li>
                        <a href="#schedule">Schedule</a>
                    </li>
                    <li>
                        <a href="#Program">Program</a>
                    </li>
                    <li>
                        <a href="#howtojoin">Howtojoin</a>
                    </li>
                    <li>
                        <a href="#PCSHSM">PCSHSM</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
				<ul class="nav navbar-nav navbar-right">                   
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Log in</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Header -->
</div>

<a name="about"></a>
<div class="content-section-a">
<?php require './pages/classic.html' ?>
</div>
    <!-- /.intro-header -->
    <!-- Page Content -->
<a  name="review"></a>
<div class="content-section-b">
    <?php require './pages/review.html' ?>
</div>
    
<a  name="tjsif2019"></a>
<div class="content-section-a">
    <?php require './pages/tjsif2019.php' ?>
</div>
    <!-- /.content-section-b -->

<a  name="schedule"></a>
<div class="content-section-b">
	<?php  require './pages/schedule.html' ?>
</div>
    <!-- /.content-section-a -->

<a name="Program"></a>
<div class="content-section-a">
	<?php require './pages/program.html' ?>
</div>

<a  name="howtojoin"></a>
<div class="content-section-a">
    <?php require './pages/howtojoin.html' ?>
</div>

	<!-- /.content-section-b -->
<a  name="ScienceWalkRally"></a>
<div class="content-section-b">
    <?php //require './pages/ScienceWalkRally.html' ?>
</div>

<a  name="pcshs"></a>
<div class="content-section-a">
    <?php require './pages/12princess.html' ?>
</div>


<a name="ssh" ></a>
<div class="content-section-b">
	<?php require './pages/ssh.html' ?>
</div>
    
	<!-- /.content-section-a -->
<a name="PCSHSP"></a>
<div class="content-section-a">
	<?php require './pages/pccm.html' ?>
</div>


<!-- /.content-section-b -->
<div class="content-section-b">
    <?php require './pages/aroundhere.html' ?>
</div>

<a name="contact"></a>
<div class="content-section-b">
	<?php require './include/footer.php' ?>
</div>

<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>


