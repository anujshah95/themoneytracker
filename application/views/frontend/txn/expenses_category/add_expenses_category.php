        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Add Category
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
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('expenses-category'); ?>">Expenses Category</a>
                                        </div>

                                        <form action="<?php echo base_url('add-expenses-category'); ?>" method="POST" name="add_expenses_category_data" id="add_expenses_category_data">
                                        <div class="col-lg-8 col-lg-offset-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Category Name :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" class="form-control" placeholder="Enter category name" name="cname" id="cname" value="<?php echo set_value('cname'); ?>" required="" autofocus >
                                                        
                                                        <div class="errorMessage" style="color:#F00;">
                                                            <?php echo form_error('cname'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
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

