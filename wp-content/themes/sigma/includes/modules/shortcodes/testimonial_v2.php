<?php $count = 1;
$query_args = array('post_type' => 'bunch_testimonials' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['testimonials_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="full-section dark-section parallax" id="testimonials" data-stellar-background-ratio="0.1" style="background-image:url( '<?php echo esc_url( $bg_img );?>' );">

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
                <div class="col-sm-12">

                    <div class="owl-carousel testimonials-carousel">
                        <?php while($query->have_posts()): $query->the_post();
						global $post;
						$client_meta = _WSH()->get_meta(); ?>
                        <div class="item">

                            <div class="testimonial style-2">

                                <blockquote>
                                    <p>&quot;<?php echo wp_kses_post( sigma_trim( get_the_content(), $text_limit ) );?>&quot;</p>
                                </blockquote>

                                <h6><?php the_title();?>, <span><?php echo wp_kses_post( sigma_set( $client_meta, 'designation' ) );?></span></h6>
                                <?php the_post_thumbnail( 'sigma_80x80' );?>

                            </div><!-- testimonial -->

                        </div><!-- item -->
                        <?php endwhile;?>
                    </div><!-- testimonials-carousel -->

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section><!-- full-section -->

<?php endif; wp_reset_postdata(); ?>