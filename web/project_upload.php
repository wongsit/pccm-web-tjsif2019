<?php
require_once("./include/session.php");

if(!isset($_GET['id'])||!isset($_GET['file'])) {
    $auth_user->redirect('project.php');
}

if(0 > $_GET['file'] || $_GET['file'] > 3){
    $auth_user->redirect('project_view.php?id=' . $_GET['id']);
}

$uploadOk = 1;

if(isset($_POST['btn-signup'])) {
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (!file_exists('uploads/projects')) {
        mkdir('uploads/projects', 0777, true);
    }

    if (!file_exists('uploads/projects/' . $_GET['id'])) {
        mkdir('uploads/projects/' . $_GET['id'], 0777, true);
    }

    $fileType = array('docx', 'pdf', 'docx', 'pdf');
    $target_dir = "uploads/projects/" . $_GET['id'] . "/";
    $target_file = $target_dir . $_GET['file'] . "." . $fileType[$_GET['file']];

    $imageFileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500 * 1024 * 1024) { //500MB
        $error[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != $fileType[$_GET['file']]) {
        $error[] = "Sorry, files type not allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error[] = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $uploadOk = 2;

        } else {
            $error[] = "Sorry, there was an error uploading your file.";
        }
    }
}

$stmt = $auth_user->runQuery("SELECT * FROM `project` WHERE id = :id");
$stmt->bindparam(":id", $_GET['id']);
$stmt->execute();
$project = $stmt->fetch(PDO::FETCH_ASSOC);


$title = 'Project';
include("./include/header.php");
include("./include/nav-bar.php");
include("./include/variable.php");
?>

<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p class="h2">Project</p>
                <p class="h3"><?=$project['name']?></p>
            </div>
            <div class="col-sm-4">
                <p>&nbsp;</p>
                <div class="btn-group-vertical pull-right">
                    <button type="button" class="btn btn-info" onclick="window.history.back();">
                        <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <p class="h3">Project upload documents</p>
        <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
        ?>
        <div class="alert alert-danger">
            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
        </div>
        <?php
                }
            } else if ($uploadOk == 2){
            ?>
            <div class="alert alert-dismissible alert-success">
                <i class="glyphicon glyphicon-ok"></i> &nbsp; Upload successfully
            </div>
            <script language="javascript">
              alert("Upload successfully")
              window.location = 'project_view.php?id=<?=$_GET['id']?>'
            </script>
            <?php
            }
            ?>


<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <fieldset>
        <!-- name -->
        <div class="form-group">
            <label class="col-lg-2 control-label"><b>Select file to upload:</b></label>
            <div class="col-lg-10">
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
            </div>
        </div>

        <!--summit -->
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default" name="reset">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-danger" name="btn-signup">Save</button>
            </div>
        </div>
    </fieldset>
</form>


    </div>
</div>



<?php include './include/footer.php' ?>
