        <div class="content-wrapper">
            <div class="page-header mb-5">
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Final Amount</h4>
                    </div>
                </div>
            </div>
            <!-- Content area -->
            <div class="panel panel-flat">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-4">
                            <h3>
                                <div>
                                    <span class="infoTooptip" title="This is the final amount which you have." data-placement="top">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </span>
                                    <label>Final amount : </label>
                                </div>
                                <div><?php echo isset($final_amount) ? $final_amount : '0'; ?></div>
                            </h3>
                        </div>
                        <div class="col-lg-8">
                            <h3>
                                <label>Funds + Debitors - Creditors</label><br>
                                <?php 
                                    $funds=isset($fund_amount) ? $fund_amount : '0';
                                    $debitors=isset($debitors_amount) ? $debitors_amount : '0';
                                    $creditors=isset($creditors_amount) ? $creditors_amount : '0'; 
                                    echo $funds .' + '. $debitors .' - '. $creditors;
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="panel panel-flat">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-4">
                            <h3>
                                <div>
                                    <span class="infoTooptip" title="Comparable amount which should be same as final amount." data-placement="top">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </span>
                                    <label>Compare amount : </label>
                                </div>
                                <?php $compare_amt=$this->user_opening_balance + $income_amount - $exp_amount; ?>
                                <div><?php echo $compare_amt; ?></div>
                            </h3>
                        </div>
                        <div class="col-lg-8">
                            <h3>
                                <label>Opening balance + Total Income - Total Expenditure</label><br>
                                <?php 
                                    $funds=isset($fund_amount) ? $fund_amount : '0';
                                    $income_amount=isset($income_amount) ? $income_amount : '0';
                                    $exp_amount=isset($exp_amount) ? $exp_amount : '0'; 
                                    echo $this->user_opening_balance .' + '. $income_amount .' - '. $exp_amount;
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="panel panel-flat">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-4">
                            <h3>
                                <div>
                                    <span class="infoTooptip" title="It shows the amount difference between final and compare amount." data-placement="top">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </span>
                                    <label>Amount Difference : </label>
                                </div>
                                <div><?php echo $final_amount-$compare_amt; ?></div>
                            </h3>
                        </div>
                        <div class="col-lg-8">
                            <h3>
                                <?php
                                    if($compare_amt==$final_amount){
                                        $sMessage="Ok";
                                    }elseif($compare_amt>$final_amount){
                                        $sMessage="You have less amount, please recheck all data you have entered.";
                                    }elseif($compare_amt<$final_amount){
                                        $sMessage="You have more amount, please recheck all data you have entered.";
                                    }else{
                                        $sMessage="";
                                    }
                                ?>
                                <label><?php echo $sMessage; ?></label>
                            </h3>
                        </div>
                    </div>
                </div>
            </div> 
        </div>