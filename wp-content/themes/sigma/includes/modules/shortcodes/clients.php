<section class="full-section updated-2 dark-section parallax" id="partners" data-stellar-background-ratio="0.1" style="background-image:url(<?php echo esc_url($bg_img); ?>);">

    <div class="full-section-overlay-color"></div>

    <div class="full-section-container">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="headline m-b50 text-center">

                        <h2><?php echo wp_kses_post($title); ?></h2>
						<p><?php echo wp_kses_post($text); ?></p>

                    </div><!-- headline -->

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="owl-carousel m-b0 clients-slider">
                        <?php foreach( $atts['clients'] as $key => $item ): ?>
                        <div class="item">
                            <a href="<?php echo esc_url( $item->link );?>"><img src="<?php echo esc_url( $item->client_img );?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>"></a>
                        </div><!-- item -->
                        <?php endforeach;?>
                    </div><!-- clients-slider -->

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section><!-- partners -->
