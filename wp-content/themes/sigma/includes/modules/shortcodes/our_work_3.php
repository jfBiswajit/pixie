<?php 
$paged = get_query_var('paged');
$args = array('post_type' => 'bunch_gallery', 'showposts'=>$num, 'orderby'=>$sort, 'order'=>$order, 'paged'=>$paged);
$terms_array = explode(",",$exclude_cats);
if($exclude_cats) $args['tax_query'] = array(array('taxonomy' => 'gallery_category','field' => 'id','terms' => $terms_array,'operator' => 'NOT IN',));
$query = new WP_Query($args);

$t = $GLOBALS['_bunch_base'];

$data_filtration = '';
$data_posts = '';
?>

<?php if( $query->have_posts() ):

ob_start();?>

	<?php $count = 0; 
	$fliteration = array();?>
	<?php while( $query->have_posts() ): $query->the_post();
		global  $post;
		$meta = get_post_meta( get_the_id(), '_bunch_projects_meta', true );
		$meta1 = _WSH()->get_meta();
		$post_terms = get_the_terms( get_the_id(), 'gallery_category');
		foreach( (array)$post_terms as $pos_term ) $fliteration[$pos_term->term_id] = $pos_term;
		$temp_category = get_the_term_list(get_the_id(), 'gallery_category', '', ', ');
	?>
		<?php $post_terms = wp_get_post_terms( get_the_id(), 'gallery_category'); 
		$term_slug = '';
		if( $post_terms ) foreach( $post_terms as $p_term ) $term_slug .= $p_term->slug.' ';?>		
           
            <?php 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			?>
            
            <div class="isotope-item <?php echo esc_attr($term_slug); ?>">

                <div class="portfolio-item">

                    <div class="portfolio-item-thumbnail">

                        <?php the_post_thumbnail('sigma_550x550'); ?>

                        <div class="portfolio-item-hover">

                            <div class="portfolio-item-description">

                                <h5><a href="<?php echo esc_url( sigma_set( $meta1, 'ext_url' ) );?>"><?php the_title(); ?></a></h5>

                            </div>

                            <a class="fancybox zoom-action" data-fancybox-group="portfolio" href="<?php echo esc_url($post_thumbnail_url); ?>"><i class="sigma-icon-add"></i></a>

                        </div>

                    </div>

                </div>

            </div>
            
<?php endwhile;?>
  
<?php wp_reset_postdata();
$data_posts = ob_get_contents();
ob_end_clean();

endif ;
ob_start();?>	 

<?php $terms = get_terms(array('gallery_category')); ?>

<section id="portfolio">

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

                <ul class="filter text-center">
                    <li><a class="active" href="#" data-filter="*"><?php esc_attr_e('All', 'sigma');?></a></li>
                    
					<?php foreach( $fliteration as $t ): ?>
                    <li><a href="#" data-filter=".<?php echo esc_attr(sigma_set( $t, 'slug' )); ?>"><?php echo wp_kses_post(sigma_set( $t, 'name')); ?></a></li>
                    <?php endforeach;?>
                </ul>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="isotope col-3 gutter">
                    
                   <?php echo wp_kses_post($data_posts); ?> 
                    
                </div><!-- isotope -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <p class="text-center"><a class="btn btn-default-1 waves load-more" href="<?php echo esc_url( $btn_link );?>"><?php echo wp_kses_post( $btn_title );?></a></p>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

</section><!-- portfolio -->