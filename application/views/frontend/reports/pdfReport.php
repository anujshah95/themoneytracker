<!DOCTYPE html>
<html>
<head>
	<title><?= $sTitle; ?></title>
</head>
<body>
  	<div class="table-responsive">
	    <table class="table table-bordered table-hover datatable" data-id="2">
	        <thead>
	            <tr>
	                <th><strong>Desc</strong></th>
	                <th>Amount</th>
	                <th>Receive date</th>
	                <th>Added date</th>
	            </tr>
	        </thead>
	        <tbody>
	            <?php
	            $i=1;
	            if(isset($arrIncome) && !empty($arrIncome)) { 
	                foreach($arrIncome as $income) {
	            ?>
	            <tr id="income_<?php echo $income->income_id; ?>">
	                <td>
	                <?php echo isset($income->income_desc) && !empty($income->income_desc) ? text_cut($income->income_desc,15) : ''; ?>
	                </td>

	                <td>
	                <?php echo isset($income->income_amount) && !empty($income->income_amount) ? $income->income_amount : ''; ?></td>

	                <td>
	                <?php echo isset($income->income_date) && !empty($income->income_date) ? short_date($income->income_date) : ''; ?>
	                </td>

	                <td>
	                <?php echo isset($income->created_date) && !empty($income->created_date) ? short_date($income->created_date) : ''; ?>
	                </td>
	            </tr>
	            <?php
	                }
	            }
	            ?>
	        </tbody>
	    </table>
    </div>
</body>
</html>