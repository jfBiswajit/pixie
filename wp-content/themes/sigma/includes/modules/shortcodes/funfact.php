<section class="full-section dark-section updated parallax" id="section-3" data-stellar-background-ratio="0.1" style="background-image:url(<?php echo esc_url($bg_img); ?>);">

    <div class="full-section-overlay-color"></div>

    <div class="full-section-container">

        <div class="container">
            <div class="row">
                <?php foreach( $atts['our_skills'] as $key => $item ): ?>
                <div class="col-sm-3">

                    <div class="counter">

                        <div class="counter-value" data-value="<?php echo esc_attr($item->data_value); ?>" data-symbol-after="<?php echo esc_attr($item->data_symbol); ?>"></div>
                        <div class="counter-details"><?php echo wp_kses_post($item->title); ?></div>

                    </div><!-- counter -->

                </div>
                <?php endforeach;?>
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section><!-- full-section -->
