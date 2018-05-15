<div class="col-sideNav bg-darkgray h-auto d-none d-md-block">
                        <div class="col-lg-12 col-md-12 bg-darkgray h-auto">
                            <div class="row bg-darkgray">

                                <!-- ---------- Sidebar Button ---------- -->
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-10 mx-auto py-md-4 px-lg-0">
                                            <a href="<?php echo base_url()?>admin/Dashboard/admin_add_post">
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

                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_home">Home</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Dashboard ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard">Dashboard</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ New post ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_new_post">New post
                                            <span class="text-s15 text-semibold text-yellow float-right">   <?php
            if(isset($sidebar_count['new_post'])) {
              echo $sidebar_count['new_post'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ New Registers ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block"  href="<?php echo base_url()?>admin/Dashboard/new_registers"> New Registers
                                            <span class="text-s15 text-yellow text-semibold float-right">  <?php
            if(isset($sidebar_count['new_reg'])) {
              echo $sidebar_count['new_reg'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------Yearly Plan ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/1">Yearly Plan
                                            <span class="text-s15 text-yellow text-semibold float-right">   <?php
            if(isset($sidebar_count['yearly_plan_count'])) {
              echo $sidebar_count['yearly_plan_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Monthly Plan ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/2">Monthly Plan
                                            <span class="text-s15 text-yellow text-semibold float-right">   <?php
            if(isset($sidebar_count['monthly_plan_count'])) {
              echo $sidebar_count['monthly_plan_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Yearly Limited Plan ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/3">Yearly Limited Plan
                                            <span class="text-s15 text-yellow text-semibold float-right">    <?php
            if(isset($sidebar_count['yearly_limit_count'])) {
              echo $sidebar_count['yearly_limit_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------Individuals------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/view_plan/4">Individuals
                                            <span class="text-s15 text-yellow text-semibold float-right">     <?php
            if(isset($sidebar_count['iniv_limit_count'])) {
              echo $sidebar_count['iniv_limit_count'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Watch List------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_watch_list">Watch List
                                            <span class="text-s15 text-yellow text-semibold float-right">    <?php
            if(isset($sidebar_count['watchlist'])) {
              echo $sidebar_count['watchlist'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Flagged ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15 d-block" href="<?php echo base_url()?>admin/Dashboard/admin_flaged_list">Flagged
                                            <span class="text-s15 text-yellow text-semibold float-right"><?php
            if(isset($sidebar_count['flaged'])) {
              echo $sidebar_count['flaged'];
            }?></span>
                                        </a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ All Categories ------ -->
                                <li class="sideListItem">
                                <div class="col-lg-10 mx-auto p-0">
                                    <a class="text-white text-s15 d-block collapsed" data-toggle="collapse" href="#collapse-example">All Categories
                                        <img class="float-right sidebar-icon" src="<?php echo base_url()?>/assets/sidebar/up-arrow (1).png">
                                    </a>
                                </div>
                            </li>

                            <!-- ------ Sublist : All Categories List ------ -->
                            <ul class="collapse list-unstyled" id="collapse-example">

                                <div class="col-lg-10 mx-auto p-0">
                                    <hr class="mt-2 sidebar-hr">
                                </div>

                                <!-- ------ Car ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=car">Car</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Bike ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=bike">Bike</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Number Plate------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=No. Plate">Number Plate</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Vertu------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=vertu">Vertu</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Watch -- ------>
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=watch">Watch</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Mobile Number -- ------>
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=Mob. No.">Mobile Number</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Boat ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=boat">Boat</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Phone ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=phone">Phone</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>

                                <!-- ------ Properties ------ -->
                                <li class="sideListItem">
                                    <div class="col-lg-10 mx-auto p-0">
                                        <a class="text-white text-s15" href="<?php echo base_url()?>admin/SearchController/listAll?category=properties">Properties</a>
                                        <hr class="mt-2 sidebar-hr">
                                    </div>
                                </li>
                            </ul>
                                <!-- /.Sublist -->
                            </ul>
                                </div>
                                <!-- /.list ends -->
                            </div>
                        </div>
                    </div>
