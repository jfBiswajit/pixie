<?php $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<?php if($style_two == 'option_1'):?>
	<section id="services">

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
                <?php while($query->have_posts()): $query->the_post();
				global $post;
				$services_meta = _WSH()->get_meta(); ?>
                <div class="col-sm-4">
    
                    <div class="service-box style-3 wow fadeInUp">
    
                        <i class="<?php echo sigma_set($services_meta, 'fontawesome'); ?>"></i>

                        <div class="service-box-content">
    
                            <h5><a href="<?php echo esc_url(sigma_set($services_meta, 'ext_url')); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo wp_kses_post(sigma_trim(get_the_content(), $text_limit)); ?></p>
    
                        </div><!-- service-box-content -->
    
                    </div><!-- service-box -->
    
                </div><!-- col -->
                <?php endwhile;?>
            </div><!-- row -->
        </div><!-- container -->
    
    </section>
<?php else:?>
    <section class="full-section dark-section parallax" id="services" data-stellar-background-ratio="0.1" style="background-image:url( '<?php echo esc_url( $bg_img );?>' );">
    
        <div class="full-section-overlay-color"></div>
    
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
                    
                    <?php while($query->have_posts()): $query->the_post();
                    global $post;
                    $services_meta = _WSH()->get_meta(); ?>
                    
                    <div class="col-sm-4">
    
                        <div class="service-box style-3 wow fadeInUp">
    
                            <i class="<?php echo sigma_set($services_meta, 'fontawesome'); ?>"></i>
    
                            <div class="service-box-content">
        
                                <h5><a href="<?php echo esc_url(sigma_set($services_meta, 'ext_url')); ?>"><?php the_title(); ?></a></h5>
                                <p><?php echo wp_kses_post(sigma_trim(get_the_content(), $text_limit)); ?></p>
        
                            </div><!-- service-box-content -->
    
                        </div><!-- service-box -->
    
                    </div><!-- col -->
                    <?php endwhile;?>
                </div><!-- row -->
            </div><!-- container -->
    
        </div><!-- full-section-container -->
    </section><!-- full-section -->
<?php endif;?>
<?php endif; wp_reset_postdata(); ?>