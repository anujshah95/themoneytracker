<div class="content-wrapper">
    <div class="page-header mb-5">
        <div class="page-header-content">
            <div class="page-title pt-5 pb-5">
                <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - investment
                </h4>
            </div>
        </div>
    </div>
    <div class="content pl-10 pr-10">
        <div id="investment">
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body pt-5 pr-5 pb-5 pl-5">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <a class="btn btn-md btn-primary" href="<?php echo base_url('add-investment'); ?>"> Add investment</a>
                                    <?php echo display_report_btn('investment'); ?>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <!-- <button class="btn btn-primary">PDF</button> -->
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-bordered table-hover datatable-highlight datatable datatable-tools-basic" data-id="2">
                                        <thead>
                                            <tr>
                                                <th>Desc</th>
                                                <th>Amount</th>
                                                <th>Investment date</th>
                                                <th>Added date</th>
                                                <th>Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            if(isset($investment_details) && !empty($investment_details)) { 
                                                foreach($investment_details as $investment) {
                                            ?>
                                            <tr id="investment_<?php echo $investment->investment_id; ?>">
                                                <td>
                                                <?php echo isset($investment->investment_desc) && !empty($investment->investment_desc) ? "<span class='more'>".$investment->investment_desc."</span>" : ''; ?>
                                                </td>

                                                <td>
                                                <?php echo isset($investment->investment_amount) && !empty($investment->investment_amount) ? $investment->investment_amount : ''; ?>
                                                </td>

                                                <td><?php echo isset($investment->investment_date) && !empty($investment->investment_date) ? short_date($investment->investment_date) : ''; ?></td>

                                                <td>
                                                <?php echo isset($investment->created_date) && !empty($investment->created_date) ? short_date($investment->created_date) : ''; ?>
                                                </td>

                                                <td>
                                                    <a href="<?php echo base_url('edit-investment/'.$investment->investment_id); ?>">
                                                        <button id="" class="btn btn-md btn-primary" title="Edit"><i class="fa fa-edit"></i></button>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="return common_delete_module('<?php echo $investment->investment_id; ?>',
                                                    'investment','investment');" id="investment_<?php echo $investment->investment_id; ?>" title="De-active"  alt="" class="">
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

