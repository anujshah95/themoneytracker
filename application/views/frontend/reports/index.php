<div class="content-wrapper">
    <div class="page-header mb-5">
        <div class="page-header-content">
            <div class="page-title pt-5 pb-5">
                <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Reports
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
                                    <div class="info"></div>
                                    <table id="" class="table table-bordered datatable " data-id="5">
                                        <thead>
                                            <tr> 
                                                <th>Month</th>
                                                <th>Income</th>
                                                <th>Expenses</th>
                                                <th>Details</th>
                                                <th>Action</th>
                                                <th style="display: none;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(isset($arrReportsDetails) && !empty($arrReportsDetails)){ 
                                                $i=0;
                                                foreach($arrReportsDetails as $arrReports){
                                                // p($arrReports);
                                                $sMonthYearDash=str_replace(" ","-",$arrReports->month_year);
                                                $sMonthYear=isset($arrReports->month_year) && !empty($arrReports->month_year) ? $arrReports->month_year : '';
                                                $iTotalIncome=isset($arrReports->total_income) && !empty($arrReports->total_income) ? 
                                                    "<a href='".base_url('income/'.$sMonthYearDash)."' target='_blank'>".$arrReports->total_income."</a>" 
                                                    : '';
                                                $iTotalExp=isset($arrReports->total_exp) && !empty($arrReports->total_exp) ? 
                                                    "<a href='".base_url('expenditure/'.$sMonthYearDash)."' target='_blank'>".$arrReports->total_exp."</a>" 
                                                    : '';
                                            ?>
                                            <tr>
                                                <td><?php echo $sMonthYear; ?></td>
                                                <td><?php echo $iTotalIncome; ?></td>
                                                <td><?php echo $iTotalExp; ?></td>
                                                <td>
                                                    <button class="btn btn-primary report-details" data-toggle="collapse" loop-id="<?php echo $i; ?>" month-year="<?php echo $sMonthYearDash; ?>" data-target="#accordion-<?php echo $i; ?>"><i class="fa fa-eye"></i></button>
                                                </td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li><a href="<?=base_url('generatePDF')."?source=monthly-report&target=$sMonthYearDash";?>" target="_blank"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                                                                <li><a href="<?=base_url('generateExcel')."?source=monthly-report&target=$sMonthYearDash";?>" target="_blank"><i class="icon-file-excel"></i> Export to .xls</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td style="display: none;"></td>
                                            </tr>
                                            <?php
                                            $i++;
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