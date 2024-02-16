<?php
require_once("./include/session.php");

if(!isset($_GET['id'])) {
    $auth_user->redirect('project.php');
}

if(isset($_POST['btn-signup']) && isset($_POST['picBase64'])) {
    if (!file_exists('media')) {
        mkdir('media', 0777, true);
    }

    if (!file_exists('media/projects')) {
        mkdir('media/projects', 0777, true);
    }

    $target_dir = "media/projects/";
    $target_file = $target_dir . $_GET['id'] . ".png";

    //thank https://stackoverflow.com/a/11511605
    $data = $_POST['picBase64'];
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);
    
    file_put_contents($target_file, $data);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.css" integrity="sha256-/n6IXDwJAYIh7aLVfRBdduQfdrab96XZR+YjG42V398=" crossorigin="anonymous" />
<style>
.file-btn {
    position: relative;
}
.file-btn input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
}

.upload-demo .upload-demo-wrap,
.upload-demo .upload-result,
.upload-demo.ready .upload-msg {
    display: none;
}
.upload-demo.ready .upload-demo-wrap {
    display: block;
}
.upload-demo.ready .upload-result {
    display: inline-block;    
}
.upload-demo-wrap {
    width: 330px;
    height: 330px;
    margin: 0 auto;
    margin-bottom: 50px;    
}

.upload-msg {
    text-align: center;
    padding: 50px;
    font-size: 22px;
    color: #aaa;
    width: 260px;
    margin: 50px auto;
    border: 1px solid #aaa;
}
</style>
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
        <p class="h3">Project upload picture</p>
        <?php
        if(isset($_POST['btn-signup']) && isset($_POST['picBase64'])) {
        ?>
            <div class="alert alert-dismissible alert-success">
                <i class="glyphicon glyphicon-ok"></i> &nbsp; Upload successfully
            </div>
        <?php
        }
        ?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <fieldset>

        <div class="form-group">
            <div class="upload-demo">
                <div class="container">
                    <div class="grid">
                        <div class="upload-msg">
                            Upload a file to start cropping
                        </div>
                        <div class="upload-demo-wrap">
                            <div id="upload-demo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--summit -->  
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <input type="hidden" id="pic-hidden" name="picBase64" value="">
                <a class="btn btn-success file-btn">
                    <span>Upload</span>
                    <input type="file" id="upload" value="Choose a file" accept="image/*" />
                </a>
                <button type="submit" class="btn btn-danger upload-result" name="btn-signup">Save</button>
            </div>
        </div>
    </fieldset>
</form>


    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.min.js" integrity="sha256-dhm9R4pgGAdElt/Z8BnKk9fsaEtqSz11u0+FwCIXHy4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.min.js" integrity="sha256-71T9z+AsSIpzvd8AuI1FI8+KPlnFK3LShS7ew6Rt4VI=" crossorigin="anonymous"></script>
<script>


var $uploadCrop;

function readFile(input) {
 	if (input.files && input.files[0]) {
	    var reader = new FileReader();
	            
	    reader.onload = function (e) {
			$('.upload-demo').addClass('ready');
	        $uploadCrop.croppie('bind', {
	            url: e.target.result
	        }).then(function(){
	            console.log('jQuery bind complete');
	        });
	            	
	    }
	            
	    reader.readAsDataURL(input.files[0]);
	}
}

$uploadCrop = $('#upload-demo').croppie({
	viewport: {
		width: 256,
		height: 256
	},
    enableExif: true
});

$('#upload').on('change', function () { readFile(this); });
$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
        size: 'viewport'
	}).then(function (resp) {
		$('#pic-hidden').val(resp);
	});
});
</script>

<?php include './include/footer.php' ?>
