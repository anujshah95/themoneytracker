        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Expenses Category
                        </h4>
                    </div>
                </div>
            </div>
            <div class="content pl-10 pr-10">
                <div id="category">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body pt-5 pr-5 pb-5 pl-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('add-expenses-category'); ?>"> Add Category</a>
                                            <?php echo display_report_btn('expenses_category'); ?>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <table class="table table-bordered table-hover datatable-highlight datatable" data-id="2">
                                                <thead>
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Added date</th>
                                                        <th>Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(isset($expenses_category) && !empty($expenses_category)) { 
                                                        foreach($expenses_category as $category) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo isset($category->cname) && !empty($category->cname) ? "<span class='more'>".$category->cname."</span>" : ''; ?></td>

                                                        <td>
                                                        <?php echo isset($category->created_date) && !empty($category->created_date) ? short_date($category->created_date) : ''; ?>
                                                        </td>

                                                        <td align="center">
                                                            <a href="<?php echo base_url('update-expenses-category/'.$category->expenses_category_id); ?>">
                                                                <button id="" class="btn btn-md btn-primary" name=""><i class="fa fa-edit"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

