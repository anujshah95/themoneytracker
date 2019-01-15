        <div class="content-wrapper">
            <div class="page-header mb-5"><!-- Page header -->
                <div class="page-header-content">
                    <div class="page-title pt-5 pb-5">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php display_session_msg(); ?></div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="<?php echo base_url('final-amount'); ?>">
                                    <div class="panel bg-blue-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <img src="<?php echo base_url('assets/images/icons/final_amount.png'); ?>" class="img-responsive" width="70" height="70">
                                            </div>
                                            <h3 class="no-margin "><?php echo isset($final_amount) ? $final_amount : '0'; ?></h3>
                                            Final Amount
                                            <div class="text-muted text-size-small"></div>
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4">
                                <a href="<?php echo base_url('income/'.date('F-Y')); ?>">
                                    <div class="panel bg-teal-400">
                                        <div class="panel-body">
                                            <div class="heading-elements"></div>
                                            <span class='fa fa-arrow-down pull-right fa-4x'></span>
                                            <h3 class="no-margin "><?php echo isset($income_amount) ? $income_amount : '0'; ?></h3>
                                            Income (<?php echo date('F'); ?>)
                                            <div class="text-muted text-size-small"></div>
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4">
                                <a href="<?php echo base_url('expenditure/'.date('F-Y')); ?>">
                                    <div class="panel bg-teal-400">
                                        <div class="panel-body">
                                            <div class="heading-elements"></div>
                                            <span class='fa fa-arrow-up pull-right fa-4x'></span>
                                            <h3 class="no-margin "><?php echo isset($exp_amount) ? $exp_amount : '0'; ?></h3>
                                            Expenses (<?php echo date('F'); ?>)
                                            <div class="text-muted text-size-small"></div>
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <a href="<?php echo base_url('fund'); ?>">
                                    <div class="panel bg-pink-400">
                                        <div class="panel-body">
                                            <span class='fa fa-money pull-right fa-4x'></span>
                                            <h3 class="no-margin"><?php echo isset($fund_amount) ? $fund_amount : '0'; ?></h3>
                                            Total Funds
                                            <div class="text-muted text-size-small"></div>
                                        </div>
                                        <div id="server-load"></div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4">
                                <a href="<?php echo base_url('debitors'); ?>">
                                    <div class="panel bg-pink-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <img src="<?php echo base_url('assets/images/icons/take.png'); ?>" class="img-responsive" width="60" height="60">
                                            </div>
                                            <h3 class="no-margin">
                                                <?php echo isset($debitors_amount) ? $debitors_amount : '0'; ?>
                                            </h3>
                                            Debitors
                                            <div class="text-muted text-size-small"></div>
                                        </div>
                                        <div id="server-load"></div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4">
                                <a href="<?php echo base_url('creditors'); ?>">
                                    <div class="panel bg-pink-400">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <img src="<?php echo base_url('assets/images/icons/give.png'); ?>" class="img-responsive" width="70" height="70">
                                            </div>
                                            <h3 class="no-margin">
                                                <?php echo isset($creditors_amount) ? $creditors_amount : '0'; ?>
                                            </h3>
                                            Creditors
                                            <div class="text-muted text-size-small"></div>
                                        </div>
                                        <div id="server-load"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <a href="<?php echo base_url('investment'); ?>">
                                    <div class="panel bg-slate">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <img src="<?php echo base_url('assets/images/icons/investment.png'); ?>" class="img-responsive" width="70" height="70">
                                            </div>
                                            <h3 class="no-margin"><?php echo isset($investment_amount) ? $investment_amount : '0'; ?></h3>
                                            Total investment
                                            <div class="text-muted text-size-small"></div>
                                        </div>
                                        <div id="server-load"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content">
                <div class="row">
                <?php 
                if(isset($exp_categories) && !empty($exp_categories)){
                    echo "<h2>Expenses analytics for ".date('F Y')."</h2>";
                    foreach($exp_categories as $cat){
                        $per_class="";
                        if(isset($cat->percentage)){
                            if($cat->percentage>=35){
                                $per_class="progress-bar-danger";
                            }elseif ($cat->percentage<35 && $cat->percentage>=25){
                                $per_class="progress-bar-warning";
                            }elseif ($cat->percentage<25 && $cat->percentage>=15){
                                $per_class="progress-bar-info";
                            }else{
                                $per_class="progress-bar-success";
                            }
                        }
                        $cname=isset($cat->cname) ? $cat->cname : "";
                ?>
                        <div class="col-lg-2">
                            <a href="<?php echo base_url('expenditure').'/'.date('F-Y').'/'.clean_url($cname); ?>" target="_blank">
                                <strong><?php echo $cname; ?></strong><br>
                            </a>
                            <span><?php echo isset($cat->cat_exp_total) ? "(".$cat->cat_exp_total.")" : ''; ?></span>
                        </div>
                        <div class="col-lg-10">
                            <a href="<?php echo base_url('expenditure/').'/'.date('F-Y').'/'.clean_url($cname); ?>" target="_blank">
                                <div class="progress skill-bar progress-striped active">
                                    <div class="progress-bar <?php echo $per_class; ?>" role="progressbar" 
                                    aria-valuenow="<?php echo isset($cat->percentage) ? $cat->percentage : ''; ?>" 
                                    aria-valuemin="0" aria-valuemax="100">
                                        <span class="skill">
                                            <i class="val"><?php echo isset($cat->percentage) ? $cat->percentage.'%' : ''; ?></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                <?php } } ?>  
                </div>
            </div>
            <div class="content"></div>
        </div>