<?php sigma_bunch_global_variable();
	$options = _WSH()->option();
	get_header(); 
	$settings  = _WSH()->option(); 
	if(sigma_set($_GET, 'layout_style')) $layout = sigma_set($_GET, 'layout_style'); else
	$layout = sigma_set( $settings, 'search_page_layout', 'full' );
	$sidebar = sigma_set( $settings, 'search_page_sidebar', 'default-sidebar' );
	_WSH()->page_settings = array('layout'=>$layout, 'sidebar'=>$sidebar);
	$layout = ($layout) ? $layout : 'full';
	$sidebar = ($sidebar) ? $sidebar : 'default-sidebar';
    if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
	$classes = ( !$layout || $layout == 'full' || sigma_set($_GET, 'layout_style')=='full' ) ? 'col-sm-12' : 'col-sm-9';
	$title = sigma_set($settings, 'search_page_header_title');
?>
<!--Start breadcrumb area-->     
<div id="page-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
    
                <h3><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h3>
    
            </div><!-- col -->
        </div><!-- row -->
    </div>
</div>
<!--End breadcrumb area-->

<!--Sidebar Page-->
<section class="blog-area">
    <div class="container">
        <div class="row">
            
            <!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-sm-3">
				<aside class="sidebar-wrapper m-r50">
					<?php dynamic_sidebar( $sidebar ); ?>
				</aside>
            </div>
			<?php } ?>
			<?php endif; ?>
            
            <!--Content Side-->	
            
            <div class="<?php echo esc_attr($classes); ?>">
                <!--Default Section-->
                <?php if(have_posts()):?>
                <section class="blog-post <?php if( $layout == 'left' ) echo 'p-l70'; elseif( $layout == 'right' ) echo 'p-r70'; else '';?>">
                	<div class="thm-unit-test">
                        <!--Blog Post-->
                        <?php while( have_posts() ): the_post(); ?>
                            <!-- blog post item -->
                            <!-- Post -->
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php get_template_part( 'blog' ); ?>
                            <!-- blog post item -->
                            </div><!-- End Post -->
                        <?php endwhile; ?>
                    </div>
                    
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
                <?php else:?>
                <div class="sigma-search  <?php if( $layout == 'left' ) echo 'p-l70'; elseif( $layout == 'right' ) echo 'p-r70'; else '';?>">
                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sigma' ); ?></p>
                    <aside>
                    	<?php get_search_form(); ?>
                    </aside>
                </div>
                <?php endif;?>
            </div>
            <!--Content Side-->
            
            <!--Sidebar-->	
            <!-- sidebar area -->
			<?php if( $layout == 'right' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-sm-3">
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