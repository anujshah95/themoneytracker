<?php
    // p($arrReports);
    $sMonthYearDash=str_replace(" ","-",$arrReports['month_year']);
    $sMonthYear=isset($arrReports['month_year']) && !empty($arrReports['month_year']) ? $arrReports['month_year'] : '';
    $iTotalIncome=isset($arrReports['total_income']) && !empty($arrReports['total_income']) ? "<a href='".base_url('income/'.$sMonthYearDash)."' target='_blank'>".$arrReports['total_income']."</a>" : '';

    $iTotalExp=isset($arrReports['total_exp']) && !empty($arrReports['total_exp']) ?  "<a href='".base_url('expenditure/'.$sMonthYearDash)."' target='_blank'>".$arrReports['total_exp']."</a>"  : '';
?>
<td colspan="5">
    <h2><?php echo $sMonthYear.' Details'; ?></h2>
    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading" >Income : <?php echo $iTotalIncome; ?></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Desc</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // p($exp_details);
                    if(isset($arrReports['income_details']) && !empty($arrReports['income_details'])){
                        foreach($arrReports['income_details'] as $arrIncome){
                            // p($arrIncome);
                            $dIncomeDate=isset($arrIncome->income_date) ? short_date($arrIncome->income_date) : '';
                            echo "<tr>";
                                echo "<td>$arrIncome->income_amount</td>";
                                echo "<td>$arrIncome->income_desc</td>";
                                echo "<td>$dIncomeDate</td>";
                            echo "</tr>";                                                                                    
                        }
                    }else{
                        echo "<tr><td colspan='3'>No records found.</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel-group">
        <div class="panel panel-primary">
            <div class="panel-heading">Expenses : <?php echo $iTotalExp; ?></div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // p($exp_details);
                    if(isset($arrReports['exp_details']) && !empty($arrReports['exp_details'])){
                        foreach($arrReports['exp_details'] as $arrExp){
                            $iCatPercentage=isset($arrExp->iPercentage) ? $arrExp->iPercentage : '';
                            $sPercentageClass="";
                            if(!empty($iCatPercentage)){
                                if($iCatPercentage>=35){
                                    $sPercentageClass="progress-bar-danger";
                                }elseif ($iCatPercentage<35 && $iCatPercentage>=25){
                                    $sPercentageClass="progress-bar-warning";
                                }elseif ($iCatPercentage<25 && $iCatPercentage>=15){
                                    $sPercentageClass="progress-bar-info";
                                }else{
                                    $sPercentageClass="progress-bar-success";
                                }
                            }
                            $sCatLink=base_url('expenditure').'/'.$sMonthYearDash.'/'.clean_url($arrExp->cname);
                            echo "<tr>";
                                echo "<td>
                                        <div class='col-md-3'>
                                            <a href='$sCatLink' target='_blank'>$arrExp->cname</a>
                                        </div>
                                        <div class='col-md-9'>
                                            <a href='$sCatLink' target='_blank'>
                                                <div class='progress skill-bar progress-striped active'>
                                                    <div class='progress-bar $sPercentageClass' role='progressbar' aria-valuenow='$iCatPercentage' aria-valuemin='0' aria-valuemax='100'>
                                                        <span class='skill'>
                                                            <i class='val'>$iCatPercentage%</i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </td>";
                                echo "<td>$arrExp->cat_exp_total</td>";
                            echo "</tr>";                                                                                    
                        }
                    }else{
                        echo "<tr><td colspan='2'>No records found.</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</td>
<td style="display: none;"></td>
<td style="display: none;"></td>
<td style="display: none;"></td>
<td style="display: none;"></td>
<script type="text/javascript">
    $(document).ready(function(){
        //---------------------------------
        $('.progress .progress-bar').css("width",
            function(){
                return $(this).attr("aria-valuenow") + "%";
            }
        )
    });
</script>