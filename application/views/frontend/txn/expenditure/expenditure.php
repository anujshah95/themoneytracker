        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Expenditure
                        </h4>
                    </div>
                </div>
            </div>
            <div class="content pl-10 pr-10">
                <div id="paid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body pt-5 pr-5 pb-5 pl-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('add-expenditure'); ?>"> Add Expenditure</a>
                                            <?php echo display_report_btn('expenditure'); ?>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <table class="table table-bordered table-hover datatable-highlight datatable" data-id="3">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Desc</th>
                                                        <th>Amount</th>
                                                        <th>Payment date</th>
                                                        <th>Added date</th>
                                                        <th>Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i=1;
                                                    if(isset($expenditure) && !empty($expenditure)) { 
                                                        foreach($expenditure as $paid) {
                                                    ?>
                                                    <tr id="expenditure_<?php echo $paid->expenditure_id; ?>">    
                                                        <td>
                                                        <?php echo isset($paid->cname) && !empty($paid->cname) ? "<span class='more'>".$paid->cname."</span>" : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($paid->exp_desc) && !empty($paid->exp_desc) ? "<span class='more'>".$paid->exp_desc."</span>" : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($paid->exp_amount) && !empty($paid->exp_amount) ? $paid->exp_amount : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($paid->exp_date) && !empty($paid->exp_date) ? short_date($paid->exp_date) : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($paid->created_date) && !empty($paid->created_date) ? short_date($paid->created_date) : ''; ?>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url('update-expenditure/'.$paid->expenditure_id); ?>">
                                                                <button id="" class="btn btn-md btn-primary" title="Edit"><i class="fa fa-edit"></i></button>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="return common_delete_module('<?php echo $paid->expenditure_id; ?>',
                                                            'expenditure','expenditure');" id="expenditure_<?php echo $paid->expenditure_id; ?>" title="De-active"  alt="" class="">
                                                                <button id="" class="btn btn-md btn-primary" title="Delete"><i class="fa fa-trash-o"></i></button>
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