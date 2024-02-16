<div class="container">

<div class="row">

	<div class="col-sm-12">
		<img class="img-responsive  d-block w-100" src="<?php echo base_url(); ?>assets/images/orgs/kosen.jpg" alt="seishin high school">
	</div>
<div class="col-md-6">
	<br/>
	<a class="btn btn-outline-primary" href="<?php echo base_url(); ?>assets/docs/kosen_general_brochure.pdf" target="_blank">>> Read more</a>
</div>
<?php if($introduce_kosen != null){ ?>
<div class="row">
	<div class="col-sm-8">
		<hr class="featurette-divider">
		<h1 class="text-warning">Introduce a School</h1>
		<h2 class="text-info">
			<?php
			echo $introduce_kosen->shortname;
			?>
		</h2>
		<h3 class="text-muted">
			<?php
			echo $introduce_kosen->name;
			?>
		</h3>
		<p>
			<?php
			echo '<b>About</b>: '.$introduce_kosen->about;
			?>
		</p>
	</div>
	<div class="col-sm-4">
		<?php $img_check = file_exists('assets/images/orgs/tjsif2019-org-'.$introduce_kosen->id.'.jpg');
		if($img_check){ ?>
			<img src="<?php echo base_url(); ?>assets/images/orgs/tjsif2019-org-<?php echo $introduce_kosen->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
		<?php }else{ ?>
			<i class='fas fa-school' style='font-size:240px;color:lightblue'></i>
		<?php  } ?>
	</div>
</div>
<?php  } ?>

</div>

</div>
<!-- /.container -->
