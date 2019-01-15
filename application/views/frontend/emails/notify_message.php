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
                <div class="col-md-12 text-center" style="padding: 20px 0">
                <?php
                    $logo_path=base_url('assets/images/site_logo/'.$this->site_logo);
                    echo "<a href='".base_url()."'><img src='".$logo_path."' height='100' width='100'></a>";
                ?>
                </div>
                <h1 style="text-transform: uppercase; font-size: 30px;"><?php if(isset($message_title)) echo $message_title; ?></h1>
                <p style="margin-top: 15px; line-height: 30px;"><?php if(isset($body_message)) echo $body_message; ?></p>
            </div> 
        </div> 
    </body>
</html>
