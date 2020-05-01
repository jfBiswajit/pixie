<?php $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['category_name'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section id="blog">

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
			$post_meta = _WSH()->get_meta(); 
			$term_list = wp_get_post_terms( get_the_id(), 'post_tag', array( "fields" => "names" ) );
			?>
            <div class="col-sm-4">

                <div class="blog-article">

                    <div class="blog-article-thumbnail">

                        <a class="date" href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><small><?php echo get_the_date('M');?></small> <span><?php echo get_the_date('d');?></span> <small><?php echo get_the_date('Y');?></small></a>
                        <a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('sigma_480x340')?></a>

                    </div><!-- blog-article-thumbnail -->

                    <div class="blog-content-inner">
                        <div class="blog-article-details">
                            <a class="author bg-grip" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author();?></a>
                            <a class="comments bg-grip" href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>"><?php comments_number( wp_kses_post(__('0 Comments' , 'sigma')), wp_kses_post(__('1 Comment' , 'sigma')), wp_kses_post(__('% Comments' , 'sigma'))); ?></a>
                        </div><!-- blog-article-details -->
                        
                        <h5 class="blog-article-title cap"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title();?></a></h5>
    
                        <div class="blog-article-content">
    
                            <p><?php echo wp_kses_post( sigma_trim( get_the_content(), $text_limit ) );?></p>
    
                            <a class="btn btn-default-1 waves c-w" href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php esc_html_e( 'Read More', 'sigma' );?></a>
    
                        </div><!-- blog-article-content -->
                    </div>

                </div><!-- blog-article -->

            </div><!-- col -->
            <?php endwhile;?>
        </div><!-- row -->
    </div><!-- container -->

</section><!-- blog -->

<?php endif; wp_reset_postdata(); ?>