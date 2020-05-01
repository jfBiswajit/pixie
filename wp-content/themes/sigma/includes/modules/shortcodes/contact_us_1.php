<section class="full-section parallax" id="contact" data-stellar-background-ratio="0.1" style="background-image:url( '<?php echo esc_url( $bg_img );?>' );">
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
                
                <?php foreach( $atts['contact'] as $key => $item ): ?>
                
                <div class="col-sm-4">

                    <div class="contact-box wow fadeInUp">

                        <i class="<?php echo esc_attr( $item->icon )?>"></i>

                        <h5><?php echo wp_kses_post($item->c_title); ?></h5>

                        <p><?php echo wp_kses_post($item->c_text); ?></p>

                    </div><!-- contact-box -->

                </div><!-- col -->
                
                <?php endforeach;?>
                
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section><!-- contact -->
