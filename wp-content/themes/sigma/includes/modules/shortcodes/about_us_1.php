<section id="about">
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
	
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="text-uppercase"><?php echo wp_kses_post($customize_title); ?></h5>
                <p><?php echo wp_kses_post($customize_text); ?></p>
                <h5 class="text-uppercase"><?php echo wp_kses_post($md_title); ?></h5>
                <p><?php echo wp_kses_post($md_text); ?></p>
            </div><!-- col -->
            <div class="col-sm-6">
            	<?php foreach( $atts['about_skills'] as $key => $item ): ?>
                <div class="progress-bar-title"><?php echo wp_kses_post($item->title); ?></div>
                <div class="progress">
                    <div class="progress-bar" data-width="<?php echo wp_kses_post($item->skills); ?>">
                        <span><?php echo wp_kses_post($item->skills); ?><?php esc_html_e('%', 'sigma'); ?></span>
                    </div><!-- progress-bar -->
                </div><!-- progress -->
                <?php endforeach; ?>
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- about -->
