<?php $options = _WSH()->option();
	get_header(); 
	$settings  = sigma_set(sigma_set(get_post_meta(get_the_ID(), 'bunch_page_meta', true) , 'bunch_page_options') , 0);
	$meta = _WSH()->get_meta('_bunch_layout_settings');
	$meta1 = _WSH()->get_meta('_bunch_header_settings');
	$meta2 = _WSH()->get_meta();
	_WSH()->page_settings = $meta;
	if(sigma_set($_GET, 'layout_style'))
	$layout = sigma_set($_GET, 'layout_style');
	else
	$layout = sigma_set( $meta, 'layout', 'full' );
	if( !$layout || $layout == 'full' || sigma_set($_GET, 'layout_style')=='full' )
	$sidebar = '';
	else
	$sidebar = sigma_set( $meta, 'sidebar', 'blog-sidebar' );
	$layout = ($layout) ? $layout : 'full';
	$sidebar = ($sidebar) ? $sidebar : 'blog-sidebar';
    $classes = ( !$layout || $layout == 'full' || sigma_set($_GET, 'layout_style')=='full' ) ? 'col-sm-12' : 'col-sm-9';
	/** Update the post views counter */
	$bg = sigma_set($meta1, 'header_img');
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
<section class="blog-single-area">
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
                <section class="default-section m-b50 <?php if( $layout == 'left' ) echo 'p-l70'; elseif( $layout == 'right' ) echo 'p-r70'; else '';?>">
                    <div class="thm-unit-test">
						<?php while( have_posts() ): the_post(); 
                            $post_meta = _WSH()->get_meta();
                            $term_list = wp_get_post_terms( get_the_id(), 'post_tag', array( "fields" => "names" ) );
                        ?>
                        <div class="blog-article single-blog-article">
                            <?php if( has_post_thumbnail() ):?>
                            <div class="blog-article-thumbnail m-b30">
                                <a class="date" href="<?php echo get_month_link(get_the_date('Y'), get_the_date('m')); ?>"><small><?php echo get_the_date('M');?></small> <span><?php echo get_the_date('d');?></span> <small><?php echo get_the_date('Y');?></small></a>
                                <?php the_post_thumbnail('sigma_1170x500')?>
                            </div><!-- blog-article-thumbnail -->
                            <?php endif;?>
                            <div class="blog-article-details p-l80">
                                <a class="author bg-grip" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author();?></a>
                                <a class="comments bg-grip" href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>"><?php comments_number( wp_kses_post(__('0 Comments' , 'sigma')), wp_kses_post(__('1 Comment' , 'sigma')), wp_kses_post(__('% Comments' , 'sigma'))); ?></a>
                            </div><!-- blog-article-details -->
                        
                            <div class="blog-article-content text">
                                <?php the_content();?>
                                <div class="clearfix"></div>
                                <div class="wp-tag"><?php the_tags('Tags: ', ', '); ?></div>
                                <?php wp_link_pages(array('before'=>'<div class="paginate-links m-t30">'.esc_html__('Pages: ', 'sigma'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
                                <?php if(sigma_set($options, 'show_icons')):?>
                                <?php if(function_exists('bunch_share_us')) echo wp_kses_post(bunch_share_us(get_the_id(),$post->post_name ));?>
                                <?php endif;?>
                            </div><!-- blog-article-content -->
                        	<div class="clearfix"></div>
                            
                        </div><!-- blog-article -->
                        
                        <!--Posts Nav-->
                        <div class="posts-nav">
                            <div class="clearfix">
                                <div class="sc-nav-item pull-left">
                                    <?php previous_post_link('%link', '<h4>%title</h4> <div class="prev-post"><span class="lnr text-white fa fa-arrow-left"></span> Prev Post</div>'); ?>
                                </div>
                                <div class="sc-nav-item pull-right">
                                    <?php next_post_link('%link', '<h4>%title</h4> <div class="next-post">Next Post <span class="lnr text-white fa fa-arrow-right"></span> </div>'); ?>
                                </div>                                
                            </div>
                        </div>
                        
                        <?php comments_template(); ?>
                        
                        <?php endwhile;?>
                    </div>
                </section>
                
            </div>
            <!--Content Side-->
            
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
            
        </div>
    </div>
</section>

<?php get_footer(); ?>