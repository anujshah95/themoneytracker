    <div class="content-wrapper">
        <div class="page-header mb-5">
            <div class="page-header-content">
                <div class="page-title pt-5 pb-5">
                    <h4><a href="<?php echo base_url(); ?>" style="color:black"><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span></a> - Share</h4>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="panel panel-body login-form">
                <div class="content-divider text-muted form-group"><span></span></div>
                <ul class="list-inline form-group list-inline-condensed text-center">
                    <li><?php echo social_share('facebook'); ?></li>
                    <li><?php echo social_share('twitter'); ?></li>
                    <li><?php echo social_share('linkedin'); ?></li>
                    <li><?php echo social_share('google_plus'); ?></li>
                    <li><?php echo social_share('pinterest'); ?></li>
                    <li><?php echo social_share('tumblr'); ?></li>
                    <li><?php echo social_share('whatsapp'); ?></li>
                </ul>
                <div class="content-divider text-muted form-group"><span></span></div>
            </div>
        </div>
    </div>