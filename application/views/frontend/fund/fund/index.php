        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Fund
                        </h4>
                    </div>
                </div>
            </div>
            <div class="content pl-10 pr-10">
                <div id="fund">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body pt-5 pr-5 pb-5 pl-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('add-fund'); ?>"> Add fund</a>
                                            <?php echo display_report_btn('fund'); ?>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <table class="table table-bordered table-hover datatable-highlight datatable" data-id="2">
                                                <thead>
                                                    <tr> 
                                                        <th>Desc</th>
                                                        <th>Amount</th>
                                                        <th>Added date</th>
                                                        <th>Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(isset($fund_details) && !empty($fund_details)) { 
                                                        foreach($fund_details as $fund) {
                                                    ?>
                                                    <tr id="fund_<?php echo $fund->fund_id; ?>">                                                            
                                                        <td>
                                                        <?php echo isset($fund->fund_desc) && !empty($fund->fund_desc) ? "<span class='more'>".$fund->fund_desc."</span>" : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($fund->fund_amount) && !empty($fund->fund_amount) ? $fund->fund_amount : ''; ?>
                                                        </td>
                                                        
                                                        <td>
                                                        <?php echo isset($fund->created_date) && !empty($fund->created_date) ? short_date($fund->created_date) : ''; ?>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url('edit-fund/'.$fund->fund_id); ?>">
                                                                <button id="" class="btn btn-md btn-primary" title="Edit"><i class="fa fa-edit"></i></button>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="return common_delete_module('<?php echo $fund->fund_id; ?>',
                                                            'fund','fund');" id="fund_<?php echo $fund->fund_id; ?>" title="De-active"  alt="" class="">
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

