<?php $query_args = array('post_type' => 'bunch_gallery' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['gallery_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section id="portfolio">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="headline text-center">

                    <h2><?php echo wp_kses_post( $title );?></h2>
                    <p><?php echo wp_kses_post( $text );?></p>

                </div><!-- headline -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="isotope col-4 no-margin-bottom">
        <?php while($query->have_posts()): $query->the_post();
			global $post;
			$portfolio_meta = _WSH()->get_meta(); ?>
        
        <?php 
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		?>
        
        <div class="isotope-item">

            <div class="portfolio-item">

                <div class="portfolio-item-thumbnail">
					<?php the_post_thumbnail( 'sigma_550x550' );?>

                    <div class="portfolio-item-hover">

                        <div class="portfolio-item-description">

                            <h5><a href="<?php echo esc_url( sigma_set($portfolio_meta, '$ext_url') );?>"><?php the_title();?></a></h5>

                        </div><!-- portfolio-item-description -->

                        <a class="fancybox zoom-action" data-fancybox-group="portfolio" href="<?php echo esc_url($post_thumbnail_url); ?>"><i class="sigma-icon-add"></i></a>

                    </div><!-- portfolio-item-hover -->

                </div><!-- portfolio-item-thumbnail -->

            </div><!-- portfolio-item -->

        </div><!-- isotope-item -->
        <?php endwhile; ?>
    </div>

</section><!-- portfolio -->

<?php endif; wp_reset_postdata(); ?>