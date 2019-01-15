        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Feedback
                        </h4>
                    </div>
                </div>
            </div>
            <div class="content pl-10 pr-10">
                <div id="industry">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body pt-5 pr-5 pb-5 pl-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                            <label><h4><strong>Please let us know about your feedback,suggestions or report a bug.</strong></h4></label>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <form action="<?php echo base_url('add-feedback'); ?>" method="POST" name="feedback" id="feedback" enctype="multipart/form-data">
                                            <div class="col-lg-8 col-lg-offset-2">                                                
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Message :</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group has-feedback">
                                                            <textarea rows="5" cols="5" name="feedback_message" id="feedback_message" class="form-control textarea-max" placeholder="Enter your message" autofocus><?php echo $this->input->post('feedback_message'); ?></textarea>            
                                                            <?php echo form_error('feedback_message'); ?>
                                                        </div>
                                                    </div>
                                                </div>

                                               <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Screenshot(optional) :</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <div class="uploader">
                                                                    <input type="file" class="file-styled" name="feedback_image" id="feedback_image">
                                                                    <span class="filename" style="user-select:;">No file selected</span>
                                                                    <span class="action" style="user-select: none;"><i class="icon-plus2"></i></span>
                                                                </div>
                                                                <div class="clearfix">&nbsp;</div>
                                                                <?php echo form_error('feedback_image'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div id="img_preview_div">
                                                                <img id="img_preview">
                                                                <div style="display: none;" id="img_preview_remove">
                                                                <a class="btn btn-primary btn-sm" onclick="remove_img();"><i class="fa fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clearfix">&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <label><strong>Size limit : 5 MB.</strong></label><br>
                                                        <label><strong>File type : gif jpg png jpeg</strong></label>
                                                        <div class="clearfix">&nbsp;</div>
                                                        <label id="sImageUploadError"></label>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <button type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd">Submit</button>
                                                    </div>
                                                </div>                                          
                                                <div class="clearfix">&nbsp;</div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

