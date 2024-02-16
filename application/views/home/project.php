<div class="container">

	<div class="row">
		<div class="col-sm-5">
			<!--<hr class="section-heading-spacer">-->
			<div class="clearfix"></div>
			<h2 class="text-info"><i class='fas fa-drafting-compass  float-left' style='font-size:36px;color:lightblue;'></i>&nbsp;<strong>Students projects</strong></h2>
			<p class="lead">From grade 11 Students of Princess Chulabhorn Science High Schools (PCSH Schools), the sister schools in Thailand and Super Science High Schools (SSH Schools) in Japan</p>
		</div>

		<div class="col-sm-7">
			<div class="table-responsive">
				<h3 class="text-warning">Statistic</h3>
				<table class="table" id="rsmtb">
					<thead>
						<tr>
							<th></th>
							<th>The number of schools</th>
							<th>The number of students</th>
							<th>The number of projects</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = array(0,0,0);
						foreach ($org_types as $org_type) {
							if($org_type->id < 6){?>
								<tr>
									<td><?php echo $org_type->name; ?></td>
									<td><?php echo $students_static[$org_type->id][3];  $total[0] += $students_static[$org_type->id][3]; ?></td>
									<td><?php echo $students_static[$org_type->id][1];  $total[1] += $students_static[$org_type->id][1]; ?></td>
									<td><?php echo $students_static[$org_type->id][2];  $total[2] += $students_static[$org_type->id][2]; ?></td>
								</tr>
							<?php } } ?>
							<tr>
								<td><b>Total</b></td>
								<td><b><?php echo $total[0]; ?></b></td>
								<td><b><?php echo $total[1]; ?></b></td>
								<td><b><?php echo $total[2]; ?></b></td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>

			<div class="container">
			<div class="collapse" id="collapseExample">
				<div class="card card-body">
					<div class="table-responsive">
						<h3 class="text-success"><i class='fas fa-poll' style='font-size:36px;color:lightgreen'></i>&nbsp;Registeration Status Project</h3>
						<table class="table" id="rsmtb">
							<thead>
								<tr>
									<th>Name</th>
									<?php
									//แสดงหัวตาราง
									foreach ($project_types as $project_type){ ?>
										<th><?php echo $project_type->name; ?></th>
									<?php } ?>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$total = array(0,0,0,0,0,0,0);
								foreach ($orgs as $org) { ?>
									<tr>
										<td><?php
										$i=0;
										$total_row = 0;
										echo $org->name; ?></td>
										<?php foreach ($project_types as $project_type){ ?>
											<td><?php
											echo $org_projects[$org->id][$project_type->id];
											$total[$i] += $org_projects[$org->id][$project_type->id];
											$total_row += $org_projects[$org->id][$project_type->id];
											$i++;
											?></td>
										<?php } ?>
										<td><b><?php
										echo $total_row;
										$total[$i] += $total_row;
										?></b></td>

									</tr>
								<?php } ?>
								<tr>
									<td><b>Total</b></td>
									<?php for($i=0;$i<7;$i++){ ?>
										<td><b><?php echo $total[$i]; ?></b></td>
									<?php }  ?>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
		<p>
			<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				<i class="fa fa-th-list" aria-hidden="true"></i>&nbsp;View registration status - Project
			</button>
		</p>
		<?php if($introduce_project != null){ ?>
		<div class="row">
	    <div class="col-sm-4">
	      <?php $img_check = file_exists('assets/images/projects/tjsif2019-project-'.$introduce_project->id.'.jpg');
	      if($img_check){ ?>
	        <img src="<?php echo base_url(); ?>assets/images/projects/tjsif2019-project-<?php echo $introduce_project->id.'.jpg'; ?>" class="rounded img-responsive d-block w-100" alt="Cinque Terre">
	      <?php }else{ ?>
	        <i class='fas fa-drafting-compass' style='font-size:240px;color:lightblue'></i>
	      <?php  } ?>
	    </div>
	    <div class="col-sm-8">
				<hr class="featurette-divider">
	      <h1 class="text-warning">Introduce a Project</h1>
	      <h2 class="text-info">
	        <?php
	        echo $introduce_project->name;
	        ?>
	      </h2>
	      <h3 class="text-muted">
	        <?php
	        echo $this->Users_model->fetch_org_name($introduce_project->org_id);
	        ?>
	      </h3>
	      <p>
	        <?php
	        echo '<b>Category</b>: '.$this->Users_model->fetch_category_name($introduce_project->category_id);
	        ?>
	      </p>
	      <p>
	        <?php
	        echo '<b>Objective</b>: '.$introduce_project->objective;
	        ?>
	      </p>
	      <a href="<?php echo base_url(); ?>welcome/info/<?php echo $introduce_project->id; ?>" class="btn btn-outline-info">View Details >></a>
	    </div>
	  </div>
		 <?php  } ?>

		<div class="container">
				<div class="col-lg-12">
					<hr class="featurette-divider">
					<h2 class="text-info"><i class="fas fa-stream" aria-hidden="true"></i>&nbsp;Categories <br><small>There are six categories as follows:</small></h2>
					<!--Start Panel Group.-->
					<div  id="accordion2">
						<!--Start step one.-->
						<?php foreach ($project_types as $project_type){ ?>
						<div class="card bg-info">
							<div class="card-header" role="tab" id="heading<?php echo $project_type->id; ?>">
								<b><a class="text-light" role="button" data-toggle="collapse" data-parent="#accordion2" href="#type<?php echo $project_type->id; ?>" aria-expanded="true" aria-controls="type<?php echo $project_type->id; ?>">
									<i class="fa fa-angle-double-down fa-fw" aria-hidden="true"></i>
									<?php echo $project_type->name; ?>
									</a>
								</b>
							</div>
							<div id="type<?php echo $project_type->id; ?>"  class="collapse"  data-parent="#accordion2" role="tabpanel" aria-labelledby="heading<?php echo $project_type->id; ?>" aria-expanded="true" style="height: 0px;">
								<div class="card-body bg-light">
										<div class="row">
									<?php foreach ($projects as $project){
										if($project->category_id == $project_type->id){ ?>
											<div class="col-lg-6" style="padding-top:10px;padding-bottom:10px">
										<?php $img_check = file_exists('assets/images/projects/tjsif2019-project-'.$project->id.'_thumb.jpg');
		                if($img_check){ ?>
		                  <a href="<?php echo base_url(); ?>welcome/info/<?php echo $project->id; ?>">
		                    <img src="<?php echo base_url(); ?>assets/images/projects/tjsif2019-project-<?php echo $project->id.'_thumb.jpg'; ?>" class="rounded float-left" alt="Cinque Terre" style="padding:10px;">
		                  </a>
		                <?php }else{ ?>
		                  <i class='fas fa-drafting-compass  float-left' style='font-size:80px;color:lightblue;padding:10px;'></i>
		                <?php  } ?>
										<h6 class="text-info"> <?php echo $project->name ?></h6>
										<p class="text-mute"> <i class='fas fa-graduation-cap' style='font-size:18px;color:lightgray'></i> <?php echo $this->Org_model->fetch_org_name($project->org_id); ?></p>
										</div>

									<?php } } ?>
										</div>
									</div>
								</div>
							</div>
							<!--End step one.-->
						<?php } ?>

						</div>
					</div>
				</div>

			</div>

		</div>
		<!-- /.container -->
