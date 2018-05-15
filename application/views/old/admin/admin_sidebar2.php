<div class="col-md-3 px-md-0" id="ad_sidebar">
  <div class="widget" >
    <a  href="<?php echo base_url()?>admin/Dashboard/admin_add_post"><button type="button"  class="btn btn-default" id="ad_btnadpost">Add Post</button></a>
    <ul id="anch_sidebar" class="pl-0 list-unstyled ml-0">
      <li class="new item h-40">
        <a class="ad_anc active nav-link" href="<?php echo base_url()?>admin/Dashboard/admin_home">Home</a>
        <hr class="admin_hrs">
      </li>
      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard">Dashboard</a>
        <hr class="admin_hrs">
      </li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/admin_new_post">New Post
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['new_post'])) {
              echo $sidebar_count['new_post'];
            }?>
          </span>
        </a>
        <hr class="admin_hrs">
      </li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/new_registers">New Registers
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['new_reg'])) {
              echo $sidebar_count['new_reg'];
            }?>
          </span>
        </a>
        <hr class="admin_hrs">
      </li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/view_plan/1">Yearly Plan
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['yearly_plan_count'])) {
              echo $sidebar_count['yearly_plan_count'];
            }?>
          </span>
        </a>
        <hr class="admin_hrs">
      </li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/view_plan/2">Monthly Plan
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['monthly_plan_count'])) {
              echo $sidebar_count['monthly_plan_count'];
            }?>
          </span>
        </a>
        <hr class="admin_hrs">
      </li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/view_plan/3">Yearly Limited Plan
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['yearly_limit_count'])) {
              echo $sidebar_count['yearly_limit_count'];
            }?>
          </span>
        </a>
        <hr class="admin_hrs">
      </li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/view_plan/4">Individuals
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['iniv_limit_count'])) {
              echo $sidebar_count['iniv_limit_count'];
            }?>
          </span>
        </a>
        <hr class="admin_hrs">
      <li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/admin_watch_list">Watch List
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['watchlist'])) {
              echo $sidebar_count['watchlist'];
            }?>
          </span>
        </a>
        <hr class="admin_hrs">
      </li>

      <li class="new item h-40">
        <a class="ad_anc nav-link" href="<?php echo base_url()?>admin/Dashboard/admin_flaged_list">Flagged
          <span class="nav-link-number text-bold">
            <?php
            if(isset($sidebar_count['flaged'])) {
              echo $sidebar_count['flaged'];
            }?>
          </span>
        </a>
        <hr class="admin_vbr">
      </li>

      <li class="nav-item h-40" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed acat_anch" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
          <span class="nav-link-text">All Categories</span>
        </a>

          <ul class="sidenav-second-level collapse pl-0 pt-2" id="collapseComponents">
                                          <li class="nav-item">
                                                <a href="<?php echo base_url()?>admin/SearchController/listAll?category=car" class="acat_anch nav-link">Car</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">

                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=bike" class="acat_anch nav-link">Bike</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">

                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=No. Plate" class="acat_anch nav-link">Number Plate</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">
                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=vertu" class="acat_anch nav-link">Vertu</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">
                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=watch" class="acat_anch nav-link">Watch</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">
                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=Mob. No." class="acat_anch nav-link">Mobile Number</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">

                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=boat" class="acat_anch nav-link">Boat</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">

                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=phone" class="acat_anch nav-link">Phone</a>
                                          </li>
                                          <hr  class="acat_hr">
                                          <li class="nav-item">

                                          <a href="<?php echo base_url()?>admin/SearchController/listAll?category=properties" class="acat_anch nav-link">Property</a>
                                          </li>
                                          <hr  class="acat_hr">
                                    </ul>
      </li>
    </ul>
  </div>
</div>
