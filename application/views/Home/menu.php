
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="<?php echo base_url()?>Dashboard/index"><i class="fa fa-heartbeat" style="font-size:16px;color:#3c8dbc"></i> <span>Dashboard</span></a></li>
		<?php if($_SESSION['USER_TYPE'] == 'Admin'){ ?>
        <li><a href="<?php echo base_url()?>Designation/designationlist"><i class="fa fa-address-card" style="font-size:16px;color:#3c8dbc"></i> <span>Designation</span></a></li>
        <li><a href="<?php echo base_url()?>Speciality/specialitylist"><i class="fa fa-medkit" style="font-size:16px;color:#3c8dbc"></i> <span>Speciality</span></a></li>
		 <li><a href="<?php echo base_url()?>User/userlist"><i class="fa fa-user-secret" style="font-size:16px;color:#3c8dbc"></i> <span>Users</span></a></li>
		 <?php }else{ ?>
		 <li><a href="<?php echo base_url()?>Product/productlist"><i class="fa fa-list" style="font-size:16px;color:#3c8dbc"></i> <span>Products</span></a></li>
		 <li><a href="<?php echo base_url()?>Invoice/invoicelist"><i class="fa fa-money" style="font-size:16px;color:#3c8dbc"></i> <span>Invoice</span></a></li>	<?php } ?>
		
	  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->