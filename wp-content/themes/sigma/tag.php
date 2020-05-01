<?php sigma_bunch_global_variable();
	$options = _WSH()->option();
	get_header(); 
	$meta = _WSH()->get_term_meta( '_bunch_category_settings' );
	if(sigma_set($_GET, 'layout_style')) $layout = sigma_set($_GET, 'layout_style'); else
	$layout = sigma_set( $meta, 'layout', 'full' );
	$sidebar = sigma_set( $meta, 'sidebar', 'default-sidebar' );
	$view = sigma_set( $meta, 'view', 'list' ) ? sigma_set( $meta, 'view', 'list' ) : 'list';
	_WSH()->page_settings = array('layout'=>$layout, 'sidebar'=>$sidebar);
	$layout = ($layout) ? $layout : 'full';
	$sidebar = ($sidebar) ? $sidebar : 'default-sidebar';
    if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
	$classes = ( !$layout || $layout == 'full' ) ? 'col-lg-12 col-md-12 col-sm-12 col-xs-12' : 'col-md-9 col-sm-12 col-xs-12';
	$bg = sigma_set($meta, 'header_img');
	$title = sigma_set($meta, 'header_title');
?>
<!--Start breadcrumb area-->     
<section class="breadcrumb-area" <?php if($bg): ?>style="background-image:url(<?php echo esc_url($bg); ?>);"<?php endif; ?>>
	<div class="container text-center">
		<h1><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h1>
	</div>
</section>
<!--End breadcrumb area-->

<!--Sidebar Page-->
<section id="blog-area" class="blog-with-sidebar-area">
    <div class="container">
        <div class="row">
            
            <!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">
				<aside class="sidebar-wrapper m-r50">
					<?php dynamic_sidebar( $sidebar ); ?>
				</aside>
            </div>
			<?php } ?>
			<?php endif; ?>
            
            <!--Content Side-->	
            <div class="<?php echo esc_attr($classes); ?>">
                <!--Default Section-->
                <section class="blog-post <?php if( $layout == 'left' ) echo 'p-l70'; elseif( $layout == 'right' ) echo 'p-r70'; else '';?>">
                    <!--Blog Post-->
                    <?php while( have_posts() ): the_post(); ?>
						<!-- blog post item -->
						<!-- Post -->
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php get_template_part( 'blog' ); ?>
						<!-- blog post item -->
						</div><!-- End Post -->
					<?php endwhile; ?>
                    
                    <!--Start post pagination-->
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="post-pagination text-center">
                                <?php sigma_the_pagination(); ?>
                            </div>
                        </div> 
                    </div>
                    <!--End post pagination-->
                </section>
            </div>
            <!--Content Side-->
            
            <!--Sidebar-->	
            <!-- sidebar area -->
			<?php if( $layout == 'right' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">
				<aside class="sidebar-wrapper m-l50">
					<?php dynamic_sidebar( $sidebar ); ?>
				</aside>
            </div>
			<?php } ?>
			<?php endif; ?>
            <!--Sidebar-->
            
        </div>
    </div>
</section>

<?php get_footer(); ?>