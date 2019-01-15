        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - <?php if(!isset($edit_profile) ) echo "View Profile"; else echo "Edit Profile"; ?></h4>
                    </div>
                </div>
            </div>

            <div class="pl-10 pr-10">
                <?php if(!isset($edit_profile) ) { ?>
                    <form action="<?php echo base_url('update-profile'); ?>" method="POST" name="frm_profile" id="frm_profile" enctype="multipart/form-data">
                    <!-- Profile -->
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="panel registration-form">
                                    <div class="panel-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>

                                        <div class="text-right">
                                           <button type="submit" class="btn btn-primary " name="btnEdit" id="btnEdit">Edit Profile 
                                            </button>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"> 
                                            <img class='img-circle' height="100" width="100" style="border:1px solid black;" 
                                            src="<?php echo $this->user_profile_img; ?>"  />
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">&nbsp; </div>

                                        <table class="table">
                                            <tr>
                                                <th>Name</th>
                                                <td><?php echo $this->user_name; ?><td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td><?php echo $this->user_email; ?><td>
                                            </tr>

                                            <tr>
                                                <th>Opening Balance</th>
                                                <td><?php echo $this->user_opening_balance; ?><td>
                                            </tr>

                                            <tr>
                                                <th>Registered Date</th>
                                                <td><?php echo short_date($this->user_registered_date); ?><td>
                                            </tr>

                                            <tr>
                                                <th>Last Login</th>
                                                <td><?php echo short_date($this->user_last_login); ?><td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /registration form -->
                <?php } ?>

                <?php if(isset($edit_profile) ) { ?>
                    <form action="<?php echo base_url('update-profile-data'); ?>" method="POST" name="frm_profile" id="frm_profile" enctype="multipart/form-data"><!-- Edit form -->
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="panel registration-form">
                                    <div class="panel-body">
                                        <div class="row">
                                            <?php if ($this->session->flashdata('error_message')) { ?>
                                                 <div class="alert alert-danger">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong><?php print_r($this->session->flashdata('error_message')); ?></strong>
                                                </div>
                                            <?php } ?>

                                            <?php if ($this->session->flashdata('success_message')) { ?>
                                                <div class="alert alert-success">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                  <strong><?php echo $this->session->flashdata('success_message'); ?></strong>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label col-lg-2">Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group has-feedback">
                                                    <input type="text" class="form-control" placeholder="User Name" name="user_name" id="user_name" value="<?php echo $this->user_name; ?>" required autofocus >
                                                    <div class="form-control-feedback">
                                                        <i class="icon-user-check text-muted"></i>
                                                    </div>
                                                    <div class="errorMessage" style="color:#F00;">
                                                        <?php echo form_error('user_name'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label col-lg-2">Opening Balance</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group has-feedback">
                                                    <input type="text" class="form-control" placeholder="Opening Balance" name="opening_balance" id="opening_balance" value="<?php echo $this->user_opening_balance; ?>" required autofocus >
                                                    <div class="form-control-feedback">
                                                        <i class="fa fa-money text-muted"></i>
                                                    </div>
                                                    <div class="errorMessage" style="color:#F00;">
                                                        <?php echo form_error('opening_balance'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="control-label col-md-10">User image</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group has-feedback">
                                                        <div class="uploader">
                                                            <input type="file" class="file-styled" name="user_image" id="user_image" onchange="readLogoURL(this);">
                                                            <span class="filename" style="user-select: none;">No file selected</span>
                                                            <span class="action" style="user-select: none;"><i class="icon-plus2"></i></span>
                                                        </div>
                                                    <div class="errorMessage"><?php echo form_error('user_image'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-4">
                                                <img class='img-responsive' style="width: 150px; height: 150px;border:1px solid black;" src="<?php echo $this->user_profile_img; ?>" />
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-feedback">
                                                    <div id="img_preview_div">
                                                        <img id="img_preview">
                                                        <a class="btn btn-primary btn-sm" onclick="remove_img();"><i class="fa fa-times"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>

                                        <div class="row">
                                            <div class="`l-lg-4 col-md-4 col-sm-6 col-xs-6 mb-15">
                                                <button type="submit" class="btn btn-primary " name="btnChange" id="btnChange">Change 
                                                </button>
                                                <button type="button" class="btn btn-primary " name="btnCancel" id="btnCancel" onclick="javaacript:window.location.href='<?php echo base_url('profile'); ?>';" >Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>