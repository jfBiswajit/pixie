<section id="about">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="headline text-center">

                    <h2><?php echo wp_kses_post($title); ?></h2>
                    <p><?php echo wp_kses_post($text); ?></p>

                </div><!-- headline -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <p class="text-center wow zoomIn"><img src="<?php echo esc_url( $img );?>" alt="<?php esc_attr_e('Awesome Image', 'sigma')?>"></p>

            </div><!-- col -->
            <div class="col-sm-6">

                <br>

                <h5 class="text-uppercase"><?php echo wp_kses_post($customize_title); ?></h5>
                <p><?php echo wp_kses_post($customize_text); ?></p>
                <h5 class="text-uppercase"><?php echo wp_kses_post($md_title); ?></h5>
                <p><?php echo wp_kses_post($md_text); ?></p>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

</section><!-- full-section -->