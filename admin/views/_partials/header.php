<?php if(get_current_user_id() === FALSE):?>



<?php else:?>

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>DAK</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>DAKBRO</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
       
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <!-- <li>
               
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>-->
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo get_profile_image();?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo all_settings('user_name');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo get_profile_image();?>" class="img-circle" alt="User Image">
                <p><?php echo all_settings('user_name');?></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=site_url('users/add/'.get_current_user_id())?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=site_url('login/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo get_profile_image();?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo get_user_name();?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active ">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <li >
          <a href="<?=site_url('orders')?>">
            <i class="fa fa-table"></i> <span>Orders</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <?php if( all_settings('user_role') == 'admin'):?>
        <li >
          <a href="<?=site_url('users')?>">
            <i class="fa fa-user-circle-o"></i> <span>Users</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <li class="treeview menu-open">
          <a href="#">
            <i class="fa fa-globe"></i>
            <span>Locations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li>
              <a href="<?=site_url('countries')?>">
                <i class="fa fa-map-pin"></i> <span>Countries</span>
                <span class="pull-right-container">
                  
                </span>
              </a>
            </li>
            <li>
              <a href="<?=site_url('states')?>">
                <i class="fa fa-map-pin"></i> <span>States</span>
                <span class="pull-right-container">
                  
                </span>
              </a>
            </li>
            <li>
              <a href="<?=site_url('cities')?>">
                <i class="fa fa-map-pin"></i> <span>Cities</span>
                <span class="pull-right-container">
                </span>
              </a>
            </li>
            <li>
              <a href="<?=site_url('areas')?>">
                <i class="fa fa-map-pin"></i> <span>Areas</span>
                <span class="pull-right-container">
                </span>
              </a>
            </li>
          </ul>
</li>
       <li  >
          <a href="<?=site_url('pagesettings')?>">
            <i class="fa fa-align-justify"></i> <span>Page Settings</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
         <li  >
          <a href="<?=site_url('sliders')?>">
            <i class="fa fa-image-"></i> <span>Sliders Settings</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
         <li  >
          <a href="<?=site_url('gallery')?>">
            <i class="fa fa-image"></i> <span>Gallery</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
         <li  >
          <a href="<?=site_url('vehicles')?>">
            <i class="fa fa-motorcycle"></i> <span>Vehicles</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <li  >
          <a href="<?=site_url('services')?>">
            <i class="fa fa-html5"></i> <span>Services</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <?php endif;?>
        <li  >
          <a href="<?=site_url('shops')?>">
            <i class="fa fa-building"></i> <span>Shops</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        
        
         <?php if( all_settings('user_role') == 'admin'):?>
         <li  >
          <a href="<?=site_url('contact')?>">
            <i class="fa fa-contao"></i> <span>Contacts</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
         <li  >
          <a href="<?=site_url('testimonials')?>">
            <i class="fa fa-comments"></i> <span>Testimonials</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
         <?php endif;?>
            <?php if( all_settings('user_role') != 'admin'):?>
         <li >
          <a href="<?=site_url('holidays')?>">
            <i class="fa fa-power-off"></i> <span>Holidays</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
          <?php endif;?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

<?php endif;?>