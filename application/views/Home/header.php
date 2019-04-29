<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="600">
  <link rel="icon" href="<?php echo base_url() ?>upload/logo.JPG" type="image/x-icon" />
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>LTE-Jar/bower_components/bootstrap/dist/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>LTE-Jar/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>LTE-Jar/bower_components/Ionicons/css/ionicons.min.css">
   <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>LTE-Jar/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>LTE-Jar/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>LTE-Jar/bower_components/dataTables.net-bs/css/dataTables.bootstrap.css"/>
  <!-- Morris charts -->
  <link rel="stylesheet" href="<?php echo base_url()?>LTE-Jar/bower_components/morris.js/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>LTE-Jar/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>LTE-Jar/dist/css/skins/_all-skins.min.css">
  <!--Text Area Editor -->
  <link rel="stylesheet" href="<?php echo base_url()?>LTE-Jar/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
  
  <link rel="stylesheet" href="<?php echo base_url()?>css/extra.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>LTE-Jar/jquery-ui-1.12.1/jquery-ui.css">
  <script type="text/javascript" src="<?php echo base_url() ?>LTE-Jar/bower_components/bootstrap/js/validate.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()?>/Dashboard/index" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size:18px"><i class="fa fa-user-md" style="font-size:24px;"></i> HealthCare</span>
	  
	  <span class="logo-sm" style="font-size:14px"><i class="fa fa-user-md" style="font-size:24px;"></i></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" id="menu" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url() ?>upload/profile/<?php echo $_SESSION['IMAGE_NAME']?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['USER_ID'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
			  
              <li class="user-header" style="min-height:200px">
				<img src="<?php echo base_url() ?>upload/profile/<?php echo $_SESSION['IMAGE_NAME']?>" class="img-circle" alt="User Image">

				<p>
                  <?php echo $_SESSION['USER_FULL_NAME'] ?> - 
				  <?php echo $_SESSION['ENT_ID'] ?><br/>
				  <?php echo $_SESSION['EMAIL_ID'] ?><br/>
				  <?php echo $_SESSION['USER_TYPE'] ?><br/>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url() ?>User/user_view/<?php echo $_SESSION['ID'] ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>Login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->