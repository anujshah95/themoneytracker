<body class="bg-slate-800">
    <div class="page-container login-container"><!-- Page container -->
        <div class="page-content"><!-- Page content -->
            <div class="content-wrapper"><!-- Main content -->
                <div class="content"><!-- Content area -->
                    <form action="<?php echo base_url('check-login'); ?>" method="post"><!-- Advanced login -->
                        <div class="panel panel-body login-form">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <div class="icon-object border-warning-400 text-warning-400"><i class="icon-people"></i></div>
                                <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" class="form-control" placeholder="Email Address" name="user_email" required value="<?php echo set_value('user_email'); ?>">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                <?php echo form_error('user_email'); ?>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input type="password" class="form-control" placeholder="Password" name="user_password" required>
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                                <?php echo form_error('user_password'); ?>
                            </div>
                            

                            <div class="form-group login-options">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" class="styled" checked="checked">
                                            Remember
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
                            </div>

                            <div class="" style="text-align: center;"></div>
                            <div class="alert alert-info">
                              <strong>Enquiry : </strong><a href="mailto:<?=ADMIN_EMAIL;?>" target="_blank"><?=ADMIN_EMAIL;?></a>
                            </div>
                        </div>
                    </form>


