        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - creditors
                        </h4>
                    </div>
                </div>
            </div>
            <div class="content pl-10 pr-10">
                <div id="creditors">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body pt-5 pr-5 pb-5 pl-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('add-creditors'); ?>"> Add creditors</a>
                                            <?php echo display_report_btn('creditors'); ?>
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
                                                    $i=1;
                                                    if(isset($creditors_details) && !empty($creditors_details)) { 
                                                        foreach($creditors_details as $creditors) {
                                                    ?>
                                                    <tr id="creditors_<?php echo $creditors->creditors_id; ?>">
                                                        <td>
                                                        <?php echo isset($creditors->creditors_desc) && !empty($creditors->creditors_desc) ? "<span class='more'>".$creditors->creditors_desc."</span>" : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($creditors->creditors_amount) && !empty($creditors->creditors_amount) ? $creditors->creditors_amount : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($creditors->created_date) && !empty($creditors->created_date) ? short_date($creditors->created_date) : ''; ?>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url('edit-creditors/'.$creditors->creditors_id); ?>">
                                                                <button id="" class="btn btn-md btn-primary" title="Edit"><i class="fa fa-edit"></i></button>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="return common_delete_module('<?php echo $creditors->creditors_id; ?>',
                                                            'creditors','creditors');" id="creditors_<?php echo $creditors->creditors_id; ?>" title="De-active"  alt="" class="">
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

