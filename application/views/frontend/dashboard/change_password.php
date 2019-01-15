
        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4> <a href="<?php echo base_url(); ?>" style="color:black"> <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Change Password</h4>
                    </div>
                </div>
            </div>
            <div class=" pl-10 pr-10">
                <form name="frm_change_pwd" id="frm_change_pwd" action="<?php echo base_url('change-password-data'); ?>" method="post" >
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="panel registration-form">
                                <div class="panel-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Old Password" id="txtOldPwd" name="txtOldPwd" required >
                                        <div class="form-control-feedback">
                                            <i class="fa fa-key text-muted"></i>
                                        </div>
                                        <div class="errorMessage" style="color:#F00;" ><?php echo form_error('txtOldPwd'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="New Password" id="txtNewPwd" name="txtNewPwd"  required="" >
                                        <div class="form-control-feedback">
                                            <i class="fa fa-key text-muted"></i>
                                        </div>
                                        <div class="errorMessage"  style="color:#F00;"><?php echo form_error('txtNewPwd'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Confrim Password" id="txtNewPwd2" name="txtNewPwd2"  required="" >
                                        <div class="form-control-feedback">
                                            <i class="fa fa-key text-muted"></i>
                                        </div>
                                        <div class="errorMessage" style="color:#F00;" ><?php echo form_error('txtNewPwd2'); ?>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-15">
                                            <button type="submit" class="btn btn-primary " name="btnChange" id="btnChange">Change 
                                            </button>
                                            <button type="reset" class="btn btn-primary " name="btnCancel" id="btnCancel">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>