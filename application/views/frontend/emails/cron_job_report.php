<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(isset($email_page_title)) echo $email_page_title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>

        </style>
    </head>
    <body style="font-family:Tahoma;">
        <div class="container text-center">
            <div class="col-md-6" style="background-color: #37474f; color: rgb(255, 255, 255); float: none; margin: 140px auto 0px; padding: 20px 0px 20px 20px; font-size: 19px;">
                <div class="col-md-12 text-left" style="padding: 20px 0">
                <?php
                    $logo_path=base_url('assets/images/site_logo/'.$this->site_logo);
                    echo "<a href='".base_url()."'><img src='".$logo_path."' height='100' width='100'></a>";
                ?>
                </div>
                <p class="text-left">Hello, <?php echo $this->user_name; ?></p>
                <p style="font-size: 20px;">Your monthly money tracker report<br> for <strong><?php echo date('F Y'); ?></strong>.</p>
                <?php $currency="Rs. "; ?>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left">Opening Balance</span>
                                        <span style="float:right;width:20%;text-align:left"> 55.09</span>
                                    </p>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left"><a style="color:white;" href="<?php echo base_url('income'); ?>" target="_blank">Income</a></span>
                                        <span style="float:right;width:20%;text-align:left"><?php echo isset($income_amount) ? $currency.$income_amount : "-"; ?></span>
                                    </p>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left"><a style="color:white;" href="<?php echo base_url('expenditure'); ?>" target="_blank">Expenses</a></span>
                                        <span style="float:right;width:20%;text-align:left"><?php echo isset($exp_amount) ?  $currency.$exp_amount : ""; ?></span>
                                    </p>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left"><a style="color:white;" href="<?php echo base_url('expenditure'); ?>" target="_blank">Final Amount</a></span>
                                        <span style="float:right;width:20%;text-align:left"> <?php echo isset($final_amount) ? $currency.$final_amount : ""; ?></span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left"><a style="color:white;" href="<?php echo base_url('fund'); ?>" target="_blank">Funds</a></span>
                                        <span style="float:right;width:20%;text-align:left"> <?php echo isset($fund_amount) ? $currency.$fund_amount : ""; ?></span>
                                    </p>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left"><a style="color:white;" href="<?php echo base_url('debitors'); ?>" target="_blank">Debitors</a></span>
                                        <span style="float:right;width:20%;text-align:left"> <?php echo isset($debitors_amount) ? $currency.$debitors_amount : ""; ?></span>
                                    </p>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left"><a style="color:white;" href="<?php echo base_url('creditors'); ?>" target="_blank">Creditors</a></span>
                                        <span style="float:right;width:20%;text-align:left"> <?php echo isset($creditors_amount) ? $currency.$creditors_amount : ""; ?></span>
                                    </p>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left"><a style="color:white;" href="<?php echo base_url('investment'); ?>" target="_blank">Investments</a></span>
                                        <span style="float:right;width:20%;text-align:left"> <?php echo isset($investment_amount) ? $currency.$investment_amount : ""; ?></span>
                                    </p>
                                </td>
                            </tr>
                            <?php 
                            if(isset($exp_categories) && !empty($exp_categories)){
                                echo "<tr><td>";
                                echo "<p>Expenses analytics for ".date('F Y')."</p>";
                                foreach($exp_categories as $cat){
                                    $cname=isset($cat->cname) ? $cat->cname : "";
                            ?>
                                    <p style="font-size:14px;padding:30px 0 0 0;margin:0;clear:both;width:100%;float:left">
                                        <span style="float:left;"><a style="color:white;" href="<?php echo base_url('expenditure').'/'.clean_url($cname); ?>" target="_blank"><?php echo $cname; ?></a></span>
                                        <span style="float:right;width:20%;text-align:left"> <?php echo isset($cat->cat_exp_total) ? $currency.$cat->cat_exp_total : ''; ?></span>
                                    </p>
                            <?php } echo "</td></tr>"; } ?>
                        </tbody>
                    </table>
                </div>
<form action="<?php echo base_url('Dashboard/s3'); ?>" method="post" enctype="multipart/form-data">
  <input name="theFile" type="file" />
  <input name="Submit" type="submit" value="Upload">
</form>
                <div class="clearfix">&nbsp;</div>
                <div class="footer text-left">
                    Thanks &amp; Regards,<br>
                    <?php echo $this->site_name; ?>
                </div>
            </div> 
        </div> 
    </body>
</html>
