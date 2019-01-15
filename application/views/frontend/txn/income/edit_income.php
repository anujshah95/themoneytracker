        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Edit income
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
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('income'); ?>">Income</a>
                                        </div>

                                        <form action="<?php echo base_url('update-income'); ?>" method="POST" name="edit_income_data" id="edit_income_data">
                                        <?php
                                            $income_amount=isset($income_details[0]->income_amount) && !empty($income_details[0]->income_amount) ? $income_details[0]->income_amount : '';
                                            $income_desc=isset($income_details[0]->income_desc) && !empty($income_details[0]->income_desc) ? $income_details[0]->income_desc : '';
                                            $income_id=isset($income_details[0]->income_id) && !empty($income_details[0]->income_id) ? $income_details[0]->income_id : '';
                                            $income_date=isset($income_details[0]->income_date) && !empty($income_details[0]->income_date) ? $income_details[0]->income_date : '';
                                        ?>
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Amount :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" class="form-control" placeholder="Enter income amount" name="income_amount" id="income_amount" value="<?php echo !empty($income_amount) ? $income_amount : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('income_amount'); ?>
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
                                                        <input type="text" class="form-control" placeholder="Enter description" name="income_desc" id="income_desc" value="<?php echo !empty($income_desc) ? $income_desc : ''; ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('income_desc'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           <div class="row">
                                                <div class="col-md-3">
                                                    <label>Receive Date :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" id="datepicker" class="form-control" name="income_date" value="<?php echo !empty($income_date) ? short_date($income_date) : ''; ?>"  >

                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('income_date'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="income_id" value="<?php echo $income_id; ?>">
                                            
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
