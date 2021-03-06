        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Edit investment
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
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('investment'); ?>">Investment</a>
                                        </div>

                                        <form action="<?php echo base_url('edit-investment-data'); ?>" method="POST" name="edit_investment_data" id="edit_investment_data">
                                        <?php
                                            $investment_amount=isset($investment_details[0]->investment_amount) && !empty($investment_details[0]->investment_amount) ? $investment_details[0]->investment_amount : '';
                                            $investment_desc=isset($investment_details[0]->investment_desc) && !empty($investment_details[0]->investment_desc) ? $investment_details[0]->investment_desc : '';
                                            $investment_id=isset($investment_details[0]->investment_id) && !empty($investment_details[0]->investment_id) ? $investment_details[0]->investment_id : '';
                                            $investment_date=isset($investment_details[0]->investment_date) && !empty($investment_details[0]->investment_date) ? short_date($investment_details[0]->investment_date) : '';
                                        ?>
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Amount :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" class="form-control" placeholder="Enter investment amount" name="investment_amount" id="investment_amount" value="<?php echo !empty($investment_amount) ? $investment_amount : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('investment_amount'); ?>
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
                                                        <input type="text" class="form-control" placeholder="Enter description" name="investment_desc" id="investment_desc" value="<?php echo !empty($investment_desc) ? $investment_desc : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('investment_desc'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           <div class="row">
                                                <div class="col-md-3">
                                                    <label>Investment Date :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" id="datepicker" class="form-control" name="investment_date" value="<?php echo !empty($investment_date) ? $investment_date : ''; ?>">

                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('investment_date'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="investment_id" value="<?php echo $investment_id; ?>">
                                            
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

