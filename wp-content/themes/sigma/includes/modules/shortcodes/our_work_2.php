<?php $query_args = array('post_type' => 'bunch_gallery' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['gallery_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section id="portfolio">

    <div class="isotope no-margin-bottom">
    	<?php while($query->have_posts()): $query->the_post();
			global $post;
			$portfolio_meta = _WSH()->get_meta(); ?>
        
        <?php 
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		?>
        <div class="isotope-item <?php if(sigma_set($portfolio_meta, 'dimension') == 'full_width') echo 'item-size-2'; elseif(sigma_set($portfolio_meta, 'dimension') == 'extra_width') echo 'item-size-2'; else echo ('item-size-1'); ?>">

            <div class="portfolio-item">

                <div class="portfolio-item-thumbnail">
					
					<?php if(sigma_set($portfolio_meta, 'dimension') == 'extra_width') 
							$image_size = 'sigma_960x480'; 
						  elseif(sigma_set($portfolio_meta, 'dimension') == 'extra_height')
							$image_size = 'sigma_480x960'; 
						  elseif(sigma_set($portfolio_meta, 'dimension') == 'full_width')
							$image_size = 'sigma_960x960';
						  else
							$image_size = 'sigma_550x550'; 
						  the_post_thumbnail($image_size);
					?>

                    <div class="portfolio-item-hover">

                        <div class="portfolio-item-description">

                            <h5><a href="<?php echo esc_url( sigma_set( $portfolio_meta, 'ext_url' ) );?>"><?php the_title();?></a></h5>

                        </div><!-- portfolio-item-description -->

                        <a class="fancybox zoom-action" data-fancybox-group="portfolio" href="<?php echo esc_url($post_thumbnail_url); ?>"><i class="sigma-icon-add"></i></a>

                    </div><!-- portfolio-item-hover -->

                </div><!-- portfolio-item-thumbnail -->

            </div><!-- portfolio-item -->

        </div><!-- isotope-item -->
        <?php endwhile; ?>
    </div><!-- isotope -->

</section>

<?php endif; wp_reset_postdata(); ?>