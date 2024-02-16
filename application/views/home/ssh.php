<div class="container">

<div class="row">
	<div class="col-sm-7">
		<!--<hr class="section-heading-spacer">-->
		<div class="clearfix"></div>
		<h2 class="text-success"><strong>Super Science High Schools</strong></h2>
		<p class="lead">Super Science High Schools (SSH Schools) are senior high schools that prioritize Science, Technology and Mathematics and in so doing these schools will receive the SSH designation awarded by the Japanese Ministry of Education, Culture, Sports, Science and Technology (MEXT). The program was launched as part of its "Science Literacy Enhancement Initiatives" in 2002.</p>
		<p class="lead">SSH schools with this status receive increased funding and are encouraged to develop links with universities and other academic institutions. Selected high schools are expected to develop curricula based on Science and Mathematics in cooperation with universities or research institutes.</p>
		<p class="lead">In 2002, the first year of operation, 26 out of 77 applicant schools were awarded SSH status. As of the 2006 Academic year there are 201 schools with the designation.</p>
		<!--<p class="lead">Super Science High Schools (SSH Schools) are senior high school that prioritize Science, Technology and Mathematics and in 80 doing these schools will receive SSH designation awarded by the Japan</p>-->
	</div>

	<div class="col-sm-5">
	   <p>&nbsp;</p><p>&nbsp;</p>
		<img class="img-responsive  d-block w-100" src="<?php echo base_url(); ?>assets/images/home/seishin_pccpl_ipad_black.png" alt="seishin high school">
	</div>

<div class="col-md-6">
<img class="img-responsive  d-block w-100" src="<?php echo base_url(); ?>assets/images/home/screenshot-lapsci-japan.png">
</div>
<div class="col-md-6">
<img class="img-responsive  d-block w-100" src="<?php echo base_url(); ?>assets/images/home/screenshot-lapsci.png">
</div>
<?php if($introduce_ssh != null){ ?>
<div class="row">
	<div class="col-sm-8">
		<hr class="featurette-divider">
		<h1 class="text-warning">Introduce a School</h1>
		<h2 class="text-info">
			<?php
			echo $introduce_ssh->shortname;
			?>
		</h2>
		<h3 class="text-muted">
			<?php
			echo $introduce_ssh->name;
			?>
		</h3>
		<p>
			<?php
			echo '<b>About</b>: '.$introduce_ssh->about;
			?>
		</p>
	</div>
	<div class="col-sm-4">
		<?php $img_check = file_exists('assets/images/orgs/tjsif2019-org-'.$introduce_ssh->id.'.jpg');
		if($img_check){ ?>
			<img src="<?php echo base_url(); ?>assets/images/orgs/tjsif2019-org-<?php echo $introduce_ssh->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
		<?php }else{ ?>
			<i class='fas fa-school' style='font-size:240px;color:lightblue'></i>
		<?php  } ?>
	</div>
</div>
<?php  } ?>

</div>

</div>
<!-- /.container -->
