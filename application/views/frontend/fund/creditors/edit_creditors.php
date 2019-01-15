        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Edit creditors
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
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('creditors'); ?>">Creditors</a>
                                        </div>

                                        <form action="<?php echo base_url('edit-creditors-data'); ?>" method="POST" name="edit_creditors_data" id="edit_creditors_data">
                                        <?php
                                            $creditors_amount=isset($creditors_details[0]->creditors_amount) && !empty($creditors_details[0]->creditors_amount) ? $creditors_details[0]->creditors_amount : '';
                                            $creditors_desc=isset($creditors_details[0]->creditors_desc) && !empty($creditors_details[0]->creditors_desc) ? $creditors_details[0]->creditors_desc : '';
                                            $creditors_id=isset($creditors_details[0]->creditors_id) && !empty($creditors_details[0]->creditors_id) ? $creditors_details[0]->creditors_id : '';
                                        ?>
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Amount :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" class="form-control" placeholder="Enter creditors amount" name="creditors_amount" id="creditors_amount" value="<?php echo !empty($creditors_amount) ? $creditors_amount : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('creditors_amount'); ?>
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
                                                        <input type="text" class="form-control" placeholder="Enter description" name="creditors_desc" id="creditors_desc" value="<?php echo !empty($creditors_desc) ? $creditors_desc : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('creditors_desc'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="creditors_id" value="<?php echo $creditors_id; ?>">
                                            
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

