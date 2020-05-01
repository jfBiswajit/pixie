<section class="full-section dark-section parallax" id="main-section" data-stellar-background-ratio="0.1" data-stellar-vertical-offset="50" style="background-image:url('<?php echo esc_url($bg_img);?>');">

    <div class="full-section-container">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">

                    <h1 class="wow fadeInUp"><?php echo wp_kses_post( $title );?></h1>

                    <p class="wow fadeInUp" data-wow-delay="0.15s"><?php echo wp_kses_post( $text );?></p>

                    <br>

                    <a class="btn btn-default-1 waves wow fadeInUp" href="<?php echo esc_url( $btn_link );?>" data-wow-delay="0.3s"><?php echo wp_kses_post( $btn_title );?></a>

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section>