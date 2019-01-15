<div class="content-wrapper">
    <div class="page-header mb-5">
        <div class="page-header-content">
            <div class="page-title pt-5 pb-5">
                <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Edit Expenditure
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
                                    <a class="btn btn-md btn-primary" href="<?php echo base_url('expenditure'); ?>">Expenditures</a>
                                </div>

                                <form action="<?php echo base_url('update-expenditure'); ?>" method="POST" name="edit_expenditure_data" id="edit_expenditure_data">
                                <?php
                                    $exp_id=isset($expenditure[0]->expenditure_id) && !empty($expenditure[0]->expenditure_id) ? $expenditure[0]->expenditure_id : '';
                                    $exp_amt=isset($expenditure[0]->exp_amount) && !empty($expenditure[0]->exp_amount) ? $expenditure[0]->exp_amount : '';
                                    $expenses_category_id=isset($expenditure[0]->expenses_category_id) && !empty($expenditure[0]->expenses_category_id) ? $expenditure[0]->expenses_category_id : '';
                                    $exp_desc=isset($expenditure[0]->exp_desc) && !empty($expenditure[0]->exp_desc) ? $expenditure[0]->exp_desc : '';
                                    $exp_date=isset($expenditure[0]->exp_date) && !empty($expenditure[0]->exp_date) ? short_date($expenditure[0]->exp_date) : '';
                                ?>

                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Amount :</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" placeholder="Enter paid amount" name="exp_amt" id="exp_amt" value="<?php echo $exp_amt; ?>" required="" autofocus >
                                                
                                                <div class="errorMessage" style="color:#F00;">
                                                    <?php echo form_error('exp_amt'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Category :</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group has-feedback">
                                                <?php
                                                    if(isset($exp_cat) && !empty($exp_cat)){
                                                        echo "<select name='exp_cat' class='form-control' required>";
                                                            echo "<option disabled selected>Select Category</option>";
                                                            foreach($exp_cat as $cat){
                                                                $selected=$cat->expenses_category_id==$expenses_category_id ? 'selected' : '';
                                                                echo "<option value='".$cat->expenses_category_id."' ".$selected.">";
                                                                    echo $cat->cname;
                                                                echo "</option>";
                                                            }
                                                        echo "</select>";
                                                    }else{
                                                        echo "Create expenses category first.";
                                                    }
                                                ?>
                                                <div class="errorMessage" style="color:#F00;">
                                                    <?php echo form_error('exp_cat'); ?>
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
                                                <input type="text" class="form-control" placeholder="Enter description" name="exp_desc" id="exp_desc" value="<?php echo $exp_desc; ?>" required="" autofocus >
                                                
                                                <div class="errorMessage" style="color:#F00;">
                                                    <?php echo form_error('exp_desc'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   <div class="row">
                                        <div class="col-md-3">
                                            <label>Payment Date :</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group has-feedback">
                                                <input type="text" id="datepicker" class="form-control" name="exp_date" required="" value="<?php echo $exp_date; ?>">

                                                <div class="errorMessage" style="color:#F00;">
                                                    <?php echo form_error('exp_date'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="exp_id" value="<?php echo $exp_id; ?>">
                                    
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