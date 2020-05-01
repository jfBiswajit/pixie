<section class="full-section dark-section parallax" id="section-4" data-stellar-background-ratio="0.1" style="background-image:url( <?php echo esc_url( $bg_img );?> );">

    <div class="full-section-overlay-color"></div>

    <div class="full-section-container">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="headline text-center" style="margin-bottom: 50px;">
						<h2><?php echo wp_kses_post($title); ?></h2>
                    	<p><?php echo wp_kses_post($text); ?></p>

                    </div><!-- headline -->

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">

                    <div class="widget widget-newsletter no-margin-bottom">

                        <?php echo do_shortcode( $contact_shortcode );?>

                    </div><!-- widget-newsletter -->

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section><!-- contact -->
