<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
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

if( !$layout || $layout == 'full' || sigma_set($_GET, 'layout_style')=='full' ) $classes[] = 'col-xl-3 col-lg-3 col-md-6 col-sm-12'; else $classes[] = 'col-xl-4 col-lg-4 col-md-6 col-sm-12'; 
//$pro_num = sigma_set($options, 'number_of_product_column');
//if($pro_num == '2') $classes[] = '';
//elseif($pro_num == '4') $classes[] = '';
//else $classes[] = '';
?>
<div <?php post_class( $classes ); ?>>
	<div class="inner-box single-product-item">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	 ?>
     <div class="img-holder">
        <?php woocommerce_template_loop_product_thumbnail();?>
        <div class="overlay-style-one">
            <div class="box">
                <div class="content">
                    <ul>
                        <li>
                            <a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php esc_html_e('Quick View', 'sigma'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
     </div>
     
     <?php do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	//do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
        <div class="title-holder text-center">
            <h3><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php the_title();?></a></h3>
            <span class="rate"><?php woocommerce_template_loop_price();?></span>
        </div>
        
	<?php /**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item' );
	?>
	</div>
</div>
