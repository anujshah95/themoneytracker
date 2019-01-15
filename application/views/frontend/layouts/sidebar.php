<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <!-- <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li> -->
                    <li class="<?= isset($sSideBarDashboardActive) ? $sSideBarDashboardActive : ''; ?>"><a href="<?php echo base_url(); ?>"><i class="icon-home2"></i><span>Dashboard</span></a></li>

                    <!-- <li class="navigation-header"><span>Transacations</span> <i class="icon-menu" title=""></i></li> -->
					<li class="<?= isset($sSideBarIncomeActive) ? $sSideBarIncomeActive : ''; ?>"><a href="<?php echo base_url('income') ?>"><i class="icon-stack2"></i> <span>Income</span></a></li>
                    <li class="<?= isset($sSideBarExpensesActive) ? $sSideBarExpensesActive : '#'; ?>">
                        <a href=""><i class="icon-stack2"></i><span>Expenses</span></a>
                        <ul class="<?= isset($sSideBarExpensesActive) ? '' : 'hidden-ul'; ?>">
                            <li class="<?= isset($sSideBarExpCatActive) ? $sSideBarExpCatActive : ''; ?>">
                                <a href="<?php echo base_url('expenses-category') ?>">Category</a>
                            </li>
                            <li class="<?= isset($sSideBarExpenditureActive) ? $sSideBarExpenditureActive : ''; ?>">
                                <a href="<?php echo base_url('expenditure') ?>">Expenditure</a>
                            </li>
                        </ul> 
                    </li>

                    <li class="<?= isset($sSideBarFundActive) ? $sSideBarFundActive : ''; ?>"><a href="<?php echo base_url('fund') ?>"><i class="icon-stack2"></i><span>Funds</span></a></li>
                    <li class="<?= isset($sSideBarDebitorsActive) ? $sSideBarDebitorsActive : ''; ?>"><a href="<?php echo base_url('debitors') ?>"><i class="icon-stack2"></i><span>Debitors (To receive)</span></a></li>
                    <li class="<?= isset($sSideBarCreditorsActive) ? $sSideBarCreditorsActive : ''; ?>"><a href="<?php echo base_url('creditors') ?>"><i class="icon-stack2"></i><span>Creditors (To pay)</span></a></li>
                    
                    <li class="<?= isset($sSideBarInvestmentActive) ? $sSideBarInvestmentActive : ''; ?>"><a href="<?php echo base_url('investment'); ?>"><i class="icon-stack2"></i><span>Investments</span></a></li>

                    <li class="<?= isset($sSideBarReportActive) ? $sSideBarReportActive : ''; ?>"><a href="<?php echo base_url('reports') ?>"><i class="icon-stack2"></i><span>Reports</span></a></li>
                    <hr>
                    <?php if($this->admin_login===TRUE){ ?>
                    <li class="<?= isset($sSideBarSettingsActive) ? $sSideBarSettingsActive : ''; ?>"><a href="<?php echo base_url('site-content') ?>"><i class="icon-stack2"></i><span>Site Content</span></a></li>
                    <?php } ?>
                    <li class="<?= isset($sSideBarShareActive) ? $sSideBarShareActive : ''; ?>"><a href="<?php echo base_url('share') ?>"><i class="icon-stack2"></i><span>Share</span></a></li>
                    <li class="<?= isset($sSideBarFeedbackActive) ? $sSideBarFeedbackActive : ''; ?>"><a href="<?php echo base_url('feedback') ?>"><i class="icon-stack2"></i><span>Feedback</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>