<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$options = _WSH()->option();
$meta = _WSH()->get_meta('_bunch_layout_settings');
$meta1 = _WSH()->get_meta('_bunch_header_settings');

$layout = sigma_set( $meta, 'layout');
$sidebar = sigma_set( $meta, 'sidebar');

$layout = ($layout) ? $layout : sigma_set($options, 'woocommerce_single_page_layout');
$sidebar = ($sidebar) ? $sidebar : sigma_set($options, 'woocommerce_single_page_sidebar');

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

<!--Start shop area-->
<section id="shop-area" class="single-shop-area">
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
			
            <div class="<?php echo esc_attr($classes);?>">
            	
                <div class="shop-content">
                	<div class="single-shop-content">

						<?php
                            /**
                             * woocommerce_before_main_content hook
                             *
                             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                             * @hooked woocommerce_breadcrumb - 20
                             */
                            do_action( 'woocommerce_before_main_content' );
                        ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php wc_get_template_part( 'content', 'single-product' ); ?>
                            <?php endwhile; // end of the loop. ?>
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
		</div>
	</div>
</section>
<?php get_footer( 'shop' ); ?>
