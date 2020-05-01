<?php $options = _WSH()->option();
	get_header();
	$settings  = sigma_set(sigma_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);
	$meta = _WSH()->get_meta('_bunch_layout_settings');
	$meta1 = _WSH()->get_meta('_bunch_header_settings');
	if(sigma_set($_GET, 'layout_style')) $layout = sigma_set($_GET, 'layout_style'); else
	$layout = sigma_set( $meta, 'layout', 'full' );
	$sidebar = sigma_set( $meta, 'sidebar', 'blog-sidebar' );
    $classes = ( !$layout || $layout == 'full' || sigma_set($_GET, 'layout_style')=='full' ) ? 'col-sm-12' : 'col-sm-9';
	$title = sigma_set($meta1, 'header_title');
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
<section class="blog-area p-b60">
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
                <section class="blog-post blog-article-content <?php if( $layout == 'left' ) echo 'p-l70'; elseif( $layout == 'right' ) echo 'p-r70'; else '';?>">
                	<div class="thm-unit-test">
                        <!--Blog Post-->
                        <?php while( have_posts() ): the_post(); ?>
                            <!-- blog post item -->
                            <?php the_content(); ?>
                            <div class="clearfix"></div>
                            <?php comments_template(); ?><!-- end comments -->
                            <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'sigma'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
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