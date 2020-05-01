<section id="features">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="headline text-center" style="margin-bottom:30px;">

                    <h2><?php echo wp_kses_post($title); ?></h2>
                    <p><?php echo wp_kses_post($subtitle); ?></p>

                </div><!-- headline -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">

                <p class="text-center"><?php echo wp_kses_post($text); ?></p>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">

                <div class="owl-carousel features-slider">
                    <?php foreach( $atts['slider'] as $key => $item ): ?>
                    <div class="item">
                        <img src="<?php echo esc_url($item->img); ?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>">
                    </div><!-- item -->
                    <?php endforeach; ?>
                </div><!-- fearures-slider -->

                <img src="<?php echo esc_url( get_template_directory_uri().'/images/features/monitor.png' );?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>">

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

</section><!-- features -->
