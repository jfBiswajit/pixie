<section id="contact">

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
            <div class="col-sm-12">

                <div id="contact-form" class="cutom-class2">
					<?php echo do_shortcode($contact_shortcode);?>
                </div>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="map no-margin-bottom" data-zoom="<?php echo esc_attr( $zoom );?>" data-height="<?php echo esc_attr( $height );?>" data-address="<?php echo esc_attr( $address );?>" data-address-details="<?php echo esc_attr( $map_title );?>"></div>

</section><!-- contact -->
