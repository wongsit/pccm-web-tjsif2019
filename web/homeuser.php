<?php
require_once("./include/session.php");

$title = 'Welcome';
include("./include/header.php");
include("./include/nav-bar.php");
?>

<div class="content-section-a">
    <div class="container">
      <p class="h2">TJSSF-2018 for members :: <?php print($user['firstname']); ?></p>
       <hr />
        <div class="row">
            <div class="col-sm-6">
                <p><object data="media/users/<?=$user['id']?>.png" type="image/png" width="200" height="200">
                <span class="glyphicon glyphicon-user" style="font-size: 1800%;"></span></object></p>
            </div>
    <div class="col-sm-6">
                <div class="btn-group-vertical pull-right">
                    <a href="user_view.php?id=<?=$id?>" class="btn btn-success">
                        <span class="glyphicon glyphicon-search"></span>&nbsp;View Profile
                    </a>
                    <a href="project.php" class="btn btn-default">
                        <span class="glyphicon glyphicon-book"></span>&nbsp;Projects
                    </a>
                    <a href="user.php" class="btn btn-default">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Members
                    </a>
                    <a href="org.php" class="btn btn-default">
                        <span class="glyphicon glyphicon-briefcase"></span>&nbsp;Organizations
                    </a>
<?php
if (have_permission('user_trip')) {
?>
<a href="user_sciwalk.php" class="btn btn-default">
    <span class="fa fa-street-view" aria-hidden="true"></span>&nbsp;<font color="red">Science Walk Rally
</font></a>
                    <a href="user_trip.php" class="btn btn-default">
                        <span class="fa fa-location-arrow" aria-hidden="true"></span>&nbsp;<font color="red">Field Trip</font>
                    </a>

<?php
}
?>
                    <a href="/" class="btn btn-info">
                        <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                    </a>
                </div>
            </div>
</div>

<div class="row">
        <div class="col-sm-6">
        <div class="list-group">
  <a class="list-group-item">
    <h3>Download</h3><p class="lead">The currently available download is as follows</p>
  </a>
  <a href="./tjssf2018_document/abstract_tjssf2018.docx" class="list-group-item">Abstract (.docx)</a>
  <a href="./tjssf2018_document/sample_abstract_tjssf2018.docx" class="list-group-item">Abstract Sample (.docx) </a>
  <a href="./tjssf2018_document/FullPaper_tjssf2018.docx" class="list-group-item">Full Paper (.docx) </a>
  <a href="./tjssf2018_document/sample_FullPaper_tjssf2018.docx" class="list-group-item">Full Paper Sample (.docx) </a>
  <a href="./tjssf2018_document/PosterGuideline_tjssf2018.docx" class="list-group-item">Guidelines for the Poseter Presentation (.docx) </a>
  <a href="./tjssf2018_document/sample_poster.pdf" class="list-group-item">Poseter Presentation Sample (.pdf) </a>
</div>
       </div>
        <div class="col-sm-6">&nbsp;</div>
</div>

    </div>
</div>

<?php include './include/footer.php' ?>
