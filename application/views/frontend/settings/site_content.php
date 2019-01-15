        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Site Content</h4>
                    </div>
                </div>
            </div>
            <!-- Content area -->
            <div class="content">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row"><div class="col-lg-12"><?php display_session_msg(); ?></div></div>
                        <form role="form" class="form-horizontal" name="site_content" id="site_content" action="<?php echo base_url('update-site-content'); ?>" method="post" enctype="multipart/form-data" >
                            <?php
                            if(isset($site_content) && !empty($site_content)) { 
                                foreach($site_content as $site) {
                            ?>
                            <fieldset class="content-group">
                                <legend class="text-bold">Front Options</legend>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Site title</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-home2"></i></span>
                                            <input type="text" name="site_name" class="form-control" id="site_name" required="" value="<?php echo $site->site_name; ?>" >
                                        </div>
                                        <?php echo form_error('site_name'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">From email</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" name="from_email" class="form-control" id="from_email" required="" value="<?php echo $site->from_email; ?>">
                                        </div>
                                        <?php echo form_error('from_email'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Site logo</label>
                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <img src="<?php echo base_url('assets/images/site_logo/'.$site->site_logo); ?>" class="img-responsive"  alt="no-image" height="100" width="100">
                                            <input type="hidden" name="site_logo_name" id="site_logo_name" value="<?php echo $site->site_logo; ?>">
                                            <input type="hidden" name="site_content_id" id="site_content_id" value="<?php echo $site->site_content_id; ?>">
                                            <div class="uploader">
                                                <input type="file" class="file-styled" name="site_logo" id="site_logo" onchange="readLogoURL(this);">
                                                <span class="filename" style="user-select: none;">No file selected</span>
                                                <span class="action" style="user-select: none;"><i class="icon-plus2"></i></span>
                                            </div>
                                        </div>
                                        <?php echo form_error('site_logo'); ?>
                                    </div>
                                    <div class="col-lg-5">
                                        <div id="img_preview_div">
                                            <img id="img_preview">
                                            <a class="btn btn-primary btn-sm" onclick="remove_img();"><i class="fa fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="content-group">
                                <legend class="text-bold">Contact Details</legend>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Admin email</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" name="admin_email" class="form-control" id="admin_email" required=""  value="<?php echo $site->admin_email; ?>">
                                        </div>
                                        <?php echo form_error('admin_email'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Mobile number</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-mobile"></i></span>
                                            <input type="text" name="mobile_number" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-control" id="mobile_number" required="" value="<?php echo $site->mobile_number; ?>">
                                        </div>
                                        <?php echo form_error('mobile_number'); ?>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="content-group">
                                <legend class="text-bold">Social Networking</legend>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Facebook link</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-facebook"></i></span>
                                            <input type="text" name="facebook_url" class="form-control" id="facebook_url" required=""  value="<?php echo $site->fb_link; ?>">
                                        </div>
                                        <?php echo form_error('facebook_url'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Linkedin </label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-linkedin"></i></span>
                                            <input type="text" name="linkedin_url" class="form-control" id="linkedin_url" required="" value="<?php echo $site->linkedin_link; ?>">
                                        </div>
                                        <?php echo form_error('linkedin_url'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Twitter</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-twitter"></i></span>
                                            <input type="text" name="twitter_url" class="form-control" id="twitter_url" required="" value="<?php echo $site->twitter_link; ?>" >
                                        </div>
                                        <?php echo form_error('twitter_url'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Google plus</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-google"></i></span>
                                            <input type="text" name="google_url" class="form-control" id="google_url" required=""  value="<?php echo $site->google_link; ?>">
                                        </div>
                                        <?php echo form_error('google_url'); ?>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="content-group">
                                <legend class="text-bold"></legend>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Last updated : </label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-database-time2"></i></span>
                                            <label class="form-control"><?php echo short_date($site->updated_date,TRUE); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <hr>
                            <div class="col-lg-12 text-center">
                                <input type="submit" class="btn btn-primary btn-green" id="btnEdit" value="Update" >
                            </div>
                            <?php } } ?>
                        </form>
                    </div>
                </div>
            </div>