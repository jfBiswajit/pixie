<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$options = _WSH()->option();
$meta = _WSH()->get_meta('_bunch_layout_settings', get_option( 'woocommerce_shop_page_id' ));
$meta1 = _WSH()->get_meta('_bunch_header_settings', get_option( 'woocommerce_shop_page_id' ));

$layout = sigma_set( $meta, 'layout');
$layout = sigma_set( $_GET, 'layout' ) ? $_GET['layout'] : $layout; 
if(sigma_set($_GET, 'layout_style')) $layout = sigma_set($_GET, 'layout_style'); else

$layout = sigma_set( $meta, 'layout');
$sidebar = sigma_set( $meta, 'sidebar');

$layout = ($layout) ? $layout : sigma_set($options, 'woo_cat_page_layout');
$sidebar = ($sidebar) ? $sidebar : sigma_set($options, 'woocommerce_cat_page_sidebar');
if (is_active_sidebar( $sidebar )) {$layout = 'right';} else{$layout = 'full';}
 
$classes = ( !$layout || $layout == 'full' || sigma_set($_GET, 'layout_style')=='full' ) ? 'col-lg-12 col-md-12 col-sm-12 col-xs-12' : 'col-xl-9 col-lg-12 col-md-12 col-sm-12';
  
$title = sigma_set($meta1, 'header_title');

$title = ($title) ? $title : sigma_set($options, 'woocommerce_page_header_title');

get_header( 'shop' ); ?>

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

<!--Start Shop area-->
<section id="shop-area" class="main-shop-area">
    <div class="container">
        <div class="row clearfix">
			
			<!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
				<?php if ( is_active_sidebar( $sidebar ) ) { ?>
					<div class="col-xl-3 col-lg-8 col-md-7 col-sm-12">
                        <div class="sidebar-wrapper">
						<?php dynamic_sidebar( $sidebar ); ?>
							<?php
                                /**
                                 * woocommerce_sidebar hook
                                 *
                                 * @hooked woocommerce_get_sidebar - 10
                                 */
                                do_action( 'woocommerce_sidebar' );
                            ?>
						</div>
            		</div>
				<?php } ?>
			<?php endif; ?>

			<!-- sidebar area -->
			
			<div class="<?php echo esc_attr($classes);?>">
            	<div class="shop-content">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                	<div class="items-sorting">
                        <div class="row clearfix">
                            <div class="results-column col-lg-8 col-md-6 col-sm-6 col-xs-12">
                                <?php woocommerce_result_count();?>
                            </div>
                            <div class="select-column pull-right col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <?php
                                        /**
                                         * woocommerce_before_shop_loop hook
                                         *
                                         * @hooked woocommerce_result_count - 20
                                         * @hooked woocommerce_catalog_ordering - 30
                                         */
                                        do_action( 'woocommerce_before_shop_loop' );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
				<?php
                    /**
                     * woocommerce_before_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                     * @hooked woocommerce_breadcrumb - 20
                     */
                    do_action( 'woocommerce_before_main_content' );
                ?>
                
                <?php
                    /**
                     * woocommerce_archive_description hook
                     *
                     * @hooked woocommerce_taxonomy_archive_description - 10
                     * @hooked woocommerce_product_archive_description - 10
                     */
                    do_action( 'woocommerce_archive_description' );
                ?>

				<?php if ( have_posts() ) : ?>
        
                    <?php woocommerce_product_loop_start(); ?>
        
                        <?php woocommerce_product_subcategories(); ?>
        
                        <?php while ( have_posts() ) : the_post(); ?>
        
                            <?php wc_get_template_part( 'content', 'product' ); ?>
        
                        <?php endwhile; // end of the loop. ?>
        
                    <?php woocommerce_product_loop_end(); ?>
        
                    <?php
                        /**
                         * woocommerce_after_shop_loop hook
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    ?>
        
                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
        
                    <?php wc_get_template( 'loop/no-products-found.php' ); ?>
        
                <?php endif; ?>

				<?php
                    /**
                     * woocommerce_after_main_content hook
                     *
                     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                     */
                    do_action( 'woocommerce_after_main_content' );
                ?>
	
				</div>
            </div>

            <!-- sidebar area -->
            <?php if( $layout == 'right' ): ?>
            	<?php if ( is_active_sidebar( $sidebar ) ) { ?>
            		<div class="col-xl-3 col-lg-8 col-md-7 col-sm-12">
                        <div class="sidebar-wrapper">
							<?php dynamic_sidebar( $sidebar ); ?>
                            <?php
                                /**
                                 * woocommerce_sidebar hook
                                 *
                                 * @hooked woocommerce_get_sidebar - 10
                                 */
                                do_action( 'woocommerce_sidebar' );
                            ?>
                        </div>
                    </div>
            	<?php } ?>
            <?php endif; ?>
    		<!--Sidebar-->
    
		</div>
	</div>
</section>
<?php get_footer( 'shop' ); ?>
