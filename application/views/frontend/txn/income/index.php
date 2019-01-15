        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - income
                        </h4>
                    </div>
                </div>
            </div>

            <div class="content pl-10 pr-10">
                <div id="income">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body pt-5 pr-5 pb-5 pl-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>
                                
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <a class="btn btn-md btn-primary" href="<?php echo base_url('add-income'); ?>"> Add income</a>
                                            <?php echo display_report_btn('income'); ?>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <table class="table table-bordered table-hover datatable" data-id="2">
                                                <thead>
                                                    <tr>
                                                        <th>Desc</th>
                                                        <th>Amount</th>
                                                        <th>Receive date</th>
                                                        <th>Added date</th>
                                                        <th>Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i=1;
                                                    if(isset($income_details) && !empty($income_details)) { 
                                                        foreach($income_details as $income) {
                                                    ?>
                                                    <tr id="income_<?php echo $income->income_id; ?>">
                                                        <td>
                                                        <?php echo isset($income->income_desc) && !empty($income->income_desc) ? "<span class='more'>".$income->income_desc."</span>" : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($income->income_amount) && !empty($income->income_amount) ? $income->income_amount : ''; ?></td>

                                                        <td>
                                                        <?php echo isset($income->income_date) && !empty($income->income_date) ? short_date($income->income_date) : ''; ?>
                                                        </td>

                                                        <td>
                                                        <?php echo isset($income->created_date) && !empty($income->created_date) ? short_date($income->created_date) : ''; ?>
                                                        </td>

                                                        <td>
                                                            <a href="<?php echo base_url('update-income/'.$income->income_id); ?>">
                                                                <button id="" class="btn btn-md btn-primary" name="" title="Edit"><i class="fa fa-edit"></i></button>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="return common_delete_module('<?php echo $income->income_id; ?>',
                                                            'income','income');" id="income_<?php echo $income->income_id; ?>" title="De-active"  alt="" class="">
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

