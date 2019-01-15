        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Edit debitors
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

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('debitors'); ?>">Debitors</a>
                                        </div>

                                        <form action="<?php echo base_url('edit-debitors-data'); ?>" method="POST" name="edit_debitors_data" id="edit_debitors_data">
                                        <?php
                                            $debitors_amount=isset($debitors_details[0]->debitors_amount) && !empty($debitors_details[0]->debitors_amount) ? $debitors_details[0]->debitors_amount : '';
                                            $debitors_desc=isset($debitors_details[0]->debitors_desc) && !empty($debitors_details[0]->debitors_desc) ? $debitors_details[0]->debitors_desc : '';
                                            $debitors_id=isset($debitors_details[0]->debitors_id) && !empty($debitors_details[0]->debitors_id) ? $debitors_details[0]->debitors_id : '';
                                        ?>
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Amount :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" class="form-control" placeholder="Enter debitors amount" name="debitors_amount" id="debitors_amount" value="<?php echo !empty($debitors_amount) ? $debitors_amount : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('debitors_amount'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Description :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" class="form-control" placeholder="Enter description" name="debitors_desc" id="debitors_desc" value="<?php echo !empty($debitors_desc) ? $debitors_desc : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('debitors_desc'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="debitors_id" value="<?php echo $debitors_id; ?>">
                                            
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mb-15">
                                                    <button type="submit" class="btn btn-primary " name="btnAdd" id="btnAdd">Submit</button>
                                                    <button type="reset" class="btn btn-primary " name="btnReset" id="btnReset">Cancel</button>
                                                </div>                                                
                                            </div>                                          
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

