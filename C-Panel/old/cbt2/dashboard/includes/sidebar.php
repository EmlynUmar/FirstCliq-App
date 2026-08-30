<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
		
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="<?php echo $urlAddon; ?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        <li>
          <a href="<?php echo $urlAddon; ?>community">
            <i class="fa fa-cubes"></i> <span>Community</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        <?php if(AdminController::$role == 1): ?>

        <li>
          <a href="<?php echo $urlAddon; ?>wallet-balance">
            <i class="fa fa-money"></i> <span>API Wallet</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>
        
        <li>
          <a href="<?php echo $urlAddon; ?>system-users">
            <i class="fa fa-user-secret"></i> <span>System Users</span>
		      	<span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>
        <?php endif; ?>

        <li>
          <a href="<?php echo $urlAddon; ?>subscribers">
            <i class="fa fa-users"></i> <span>Customers</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        <li>
          <a href="<?php echo $urlAddon; ?>credit-user-account">
            <i class="fa fa-user-plus"></i> <span>Credit User</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        <li>
          <a href="<?php echo $urlAddon; ?>all-services">
            <i class="fa fa-list"></i> <span>Services</span>
		      	<span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>
        

        <li>
          <a href="<?php echo $urlAddon; ?>transactions">
            <i class="fa fa-money"></i> <span>Transactions</span>
		      	<span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        <?php if(AdminController::$role == 1): ?>

        <li>
          <a href="<?php echo $urlAddon; ?>sale-analysis">
            <i class="fa fa-area-chart"></i> <span>Sales Analysis</span>
		      	<span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>
        
        <?php endif; ?>

       
        <li>
          <a href="<?php echo $urlAddon; ?>notification-home">
            <i class="fa fa-wechat"></i> <span>Notifications</span>
		      	<span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        
        <?php if(AdminController::$role == 1): ?>
        
        <li>
          <a href="<?php echo $urlAddon; ?>configurations">
            <i class="fa fa-cog"></i> <span>Configurations</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        <?php endif; ?>

        <li>
          <a href="<?php echo $urlAddon; ?>manage-account">
            <i class="fa fa-user"></i> <span>Manage Account</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>

        <li>
          <a href="<?php echo $urlAddon; ?>logout">
            <i class="fa fa-lock"></i> <span>Logout</span>
			      <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>			
        </li>
    </ul>
    </section>
  </aside>