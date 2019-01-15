<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php if(isset($header_title)) echo $header_title; ?></title>
        <meta title="Money Tracker">
        <meta name="Description" content="Track your money online through analytics, lets you find and follow your money online.Real time analytics and reports increase efficiency.">
        <meta name="Keywords" content="themoneytracker, themoneytracker.in, money tracker, Track money, money tracking in india, online money track, monthly expenses, monthly expenses tracker monthly budget tracker">
        <?php if($this->session->userdata('is_site_user_logged_in')==TRUE){ ?>
        <link href="<?php echo base_url('assets/images/site_logo/'.$this->site_logo); ?>" rel='shortcut icon'>
        <?php } ?>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/css/icons/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">
        
        <!-- <link href="<?php echo base_url('assets/css/minified/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"> -->
        <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
        
        <link href="<?php echo base_url('assets/css/minified/core.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/css/minified/colors.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/less/style.css'); ?>" rel="stylesheet" type="text/css">
		<!-- <link href="<?php echo base_url('assets/plugins/chosen/bootstrap-chosen.css'); ?>" rel="stylesheet"> -->
        <link href="<?php echo base_url('assets/css/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.15/integration/font-awesome/dataTables.fontAwesome.css">
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css'); ?>">
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css"> -->

		<link href="<?php echo base_url('assets/js/alertify/alertify.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/calc/calc.css'); ?>" rel="stylesheet" type="text/css">
    </head>

<?php if($this->session->userdata('is_site_user_logged_in')==true){ ?>
<body>
    <!-- Main navbar -->
    <div class="navbar navbar-inverse custom-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <?php echo $this->site_name; ?>
            </a>
            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">To-do list</a>
                    <ul class="dropdown-menu" id="add_loader">
                        <textarea rows="10" cols="50" id="to-do-list"><?php ps('user_to_do_list'); ?></textarea>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">Calculator</a>
                    <ul class="dropdown-menu"><?php $this->load->view(VIEW_FOLDER_NAME.'/dashboard/calc'); ?></ul>
                </li>
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <?php
							if($this->session->userdata('user_image')){
                                $img_src=base_url('assets/images/users/'.$this->session->userdata('user_image')); 
                            }
						?>
                        <img src="<?php if(isset($img_src)) echo $img_src; ?>" class="" style="width:30px;">
                        <span><?php echo $this->session->userdata('user_name');?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="<?php echo base_url('profile'); ?>"><i class="fa fa-user"></i> View Profile</a></li>
                        <li><a href="<?php echo base_url('change-password'); ?>"><i class="fa fa-key"></i> Change Password</a></li>
                        <li><a href="<?php echo base_url('logout'); ?>"><i class="icon-switch2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->
    <div class="page-container"><!-- Page container -->
        <div class="page-content"><!-- Page content -->
<?php } ?>
