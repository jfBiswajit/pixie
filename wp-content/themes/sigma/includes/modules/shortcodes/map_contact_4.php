<section class="full-section parallax" id="contact" data-stellar-background-ratio="0.1">
    <div class="full-section-container">

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
                <div class="col-md-5 col-sm-6">

                    <div id="contact-form">
                    	<?php echo do_shortcode($contact_shortcode);?>
                    </div>

                </div><!-- col -->
                <div class="col-md-offset-1 col-sm-6">

                    <div class="map no-margin-bottom" data-zoom="<?php echo esc_attr( $zoom );?>" data-height="<?php echo esc_attr( $height );?>" data-address="<?php echo esc_attr( $map_address );?>"></div>

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section>