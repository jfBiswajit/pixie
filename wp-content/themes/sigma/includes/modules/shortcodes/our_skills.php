<section class="full-section dark-section parallax" id="section-1" data-stellar-background-ratio="0.1" style="background-image:url(<?php echo esc_url($bg_img); ?>);">
    <div class="full-section-overlay-color"></div>
    <div class="full-section-container">
        <?php if( $title & $subtitle ):?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="headline text-center">
                        <h2><?php echo wp_kses_post($title); ?></h2>
                        <p><?php echo wp_kses_post($subtitle); ?></p>
                    </div><!-- headline -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
        <?php endif;?>
        <div class="container">
            <div class="row">
            	<?php foreach( $atts['our_skills'] as $key => $item ): ?>
                <div class="col-sm-3">
                    <div class="pie-chart-container">
                        <div class="pie-chart" data-percent="<?php echo esc_attr($item->skills); ?>" data-size="160" data-line-width="3" data-track-color="transparent" data-bar-color="#fff">
                            <div class="pie-chart-percent">
                                <span class="value"></span><?php esc_html_e('%', 'sigma'); ?>
                            </div><!-- pie-chart-percent -->
                        </div><!-- pie-chart -->
                        <div class="pie-chart-details">
                            <h6><?php echo wp_kses_post($item->title); ?></h6>
                            <p><?php echo wp_kses_post($item->subtitle); ?></p>
                        </div><!-- pie-chart-details -->
                    </div><!-- pie-chart-container -->
                </div><!-- col -->
                <?php endforeach; ?>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- full-section-container -->
</section><!-- full-section -->
