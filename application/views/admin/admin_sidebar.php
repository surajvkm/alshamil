<div class="col-sideNav bg-darkgray h-auto d-none d-md-block">
	<div class="col-lg-12 col-md-12 bg-darkgray h-auto">
		<div class="row bg-darkgray">

			<!-- ---------- Sidebar Button ---------- -->
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-10 mx-auto py-md-4 px-lg-0">
						<a href="<?php echo base_url()?>admin/add_post">
							<button type="button" class="btn btn-addpost">Add Post</button>
						</a>
					</div>
				</div>
			</div>

			<!-- ---------- Lists starts here ---------- -->
			<div class="col-lg-12 pt-lg-2 px-lg-0">
				<ul class="sidebar-menu list-unstyled">

					<!-------- Home ------ -->
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">

							<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/admin_home">Home</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>

					<!-- ------ Dashboard ------ -->
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">
							<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/dashboard">Dashboard</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>

					<!-- ------ New post ------ -->
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">
							<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/newpost">New post
								<span class="text-s15 text-semibold text-yellow float-right">   <?php
									if(isset($sidebar_count['new_post'])){
										echo $sidebar_count['new_post'];
									}?></span>
							</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>

					<!-- ------ New Registers ------ -->
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">
							<a class="text-white text-s15 d-block"  href="<?php echo base_url()?>admin/newregisters"> New Registers
								<span class="text-s15 text-yellow text-semibold float-right">  <?php
									if(isset($sidebar_count['new_reg'])){
										echo $sidebar_count['new_reg'];
									}?></span>
							</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>

					<!-- ------ Plans ------ -->
                                
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">
							<a class="text-white text-s15 d-block collapsed" data-toggle="collapse" href="#collapse-Plans">All Plans
								<img class="float-right sidebar-icon" src="<?php echo base_url()?>/assets/sidebar/up-arrow (1).png">
							</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>
					<ul class="collapse list-unstyled" id="collapse-Plans">
						<div class="col-lg-10 mx-auto p-0">
                            
                             
						</div>
                                
						<!-- ------ Subcription Plans Edit ------ -->
						<li class="sideListItem">
							<div class="col-lg-10 mx-auto p-0">
								<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/subcriptionplans">Edit Plans
									<span class="text-s15 text-yellow text-semibold float-right"><?php
										if(isset($sidebar_count['flaged'])){
											echo $sidebar_count['flaged'];
										}?></span>
								</a>
								<hr class="mt-2 sidebar-hr">
							</div>
						</li>
						<?php 
						$plansidebar = $this->adm->fectch_plans();
                                
						if($plansidebar->num_rows()>0) : 
                                        
						foreach($plansidebar->result() as $row): 
						
						
						
						$main_title = ucwords(str_replace(" ",' ',rtrim($row->name)));
                                
						?>
                                
						<li class="sideListItem">
							<div class="col-lg-10 mx-auto p-0">
								<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/view_plan/<?php echo $row->planId ?>"><?php echo $main_title ?>
									<span class="text-s15 text-yellow text-semibold float-right"></span>
								</a>
								<hr class="mt-2 sidebar-hr">
							</div>
						</li>

						<?php endforeach; endif;  ?>
                               
                               
					</ul>
					<!-- ------ All Categories ------ -->
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">
							<a class="text-white text-s15 d-block collapsed" data-toggle="collapse" href="#collapse-example">All Categories
								<img class="float-right sidebar-icon" src="<?php echo base_url()?>/assets/sidebar/up-arrow (1).png">
							</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>
					<!-- ------ Sublist : All Categories List ------ -->
					<ul class="collapse list-unstyled" id="collapse-example">

						<div class="col-lg-10 mx-auto p-0">
                                   
						</div>
                                
						<!-- ------ Add Category ------ -->
						<li class="sideListItem">
							<div class="col-lg-10 mx-auto p-0">
								<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/category">Add Category
									<span class="text-s15 text-yellow text-semibold float-right"><?php
										if(isset($sidebar_count['flaged'])){
											echo $sidebar_count['flaged'];
										}?></span>
								</a>
								<hr class="mt-2 sidebar-hr">
							</div>
						</li>

						<?php
                                      
						$list = $this->View_Model->get_parent_category();
						if($list->num_rows()>0){
							foreach($list->result() as $r){
                                        	
                                        	$main_title = ucwords(str_replace(" ",' ',rtrim($r->Name)));
                                        	
								?>
								<li class="sideListItem">
									<div class="col-lg-10 mx-auto p-0">
										<a class="text-white text-s15" href="<?php echo base_url()?>admin/listAll?category=<?php echo $r->CategoryId ?>&keyword="><?php echo $main_title ?></a>
										<hr class="mt-2 sidebar-hr">
									</div>
								</li>
                                        
								<?php
							}
						}
						?>    
                                
								
                               
					</ul>
					<!-- /.Sublist -->
 
					<!-- ------ Watch List------ -->
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">
							<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/admin_watch_list">Watch List
								<span class="text-s15 text-yellow text-semibold float-right">    <?php
									if(isset($sidebar_count['watchlist'])){
										echo $sidebar_count['watchlist'];
									}?></span>
							</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>

					<!-- ------ Flagged ------ -->
					<li class="sideListItem">
						<div class="col-lg-10 mx-auto p-0">
							<a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/admin_flaged_list">Flagged
								<span class="text-s15 text-yellow text-semibold float-right"><?php
									if(isset($sidebar_count['flaged'])){
										echo $sidebar_count['flaged'];
									}?></span>
							</a>
							<hr class="mt-2 sidebar-hr">
						</div>
					</li>

 								

                           
				</ul>
			</div>
			<!-- /.list ends -->
		</div>
	</div>
</div>
