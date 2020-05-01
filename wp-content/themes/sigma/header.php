<?php $options = _WSH()->option();
	sigma_bunch_global_variable();
	$icon_href = (sigma_set( $options, 'site_favicon' )) ? sigma_set( $options, 'site_favicon' ) : get_template_directory_uri().'/images/favicon.png';
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ): ?>
	<link rel="shortcut icon" href="<?php echo esc_url($icon_href); ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo esc_url($icon_href); ?>" type="image/x-icon">
<?php endif; ?>
<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
	  $meta = _WSH()->get_meta( '_bunch_header_settings' );
	  if(sigma_set( $meta, 'header_style' )) $header_style = sigma_set( $meta, 'header_style' ); else
	  $header_style = sigma_set($options, 'header_style', 'header_v1');
	if($header_style == 'header_v1') :
		$class = 'header-classic footer-dark';
	elseif($header_style == 'header_v2') :
		$class = 'header-classic-over footer-dark';
	elseif($header_style == 'header_v3') :
		$class = 'header-modern footer-dark';
	elseif($header_style == 'header_v4') :
		$class = 'header-split footer-dark';
	elseif($header_style == 'header_v5') :
		$class = 'header-split-over';
	elseif($header_style == 'header_v6') :
		$class = 'header-center footer-dark';
	else:
		$class = 'header-classic footer-dark';
	endif;
?>

<!--Start body class-->
<div class="sticky-header default-header <?php echo esc_attr($class); ?>">

 	
	<?php if(sigma_set($options, 'preloader')): ?>
    <!-- PAGE LOADER -->
    <div id="page-loader">
        <div class="loader"></div>
    </div>
    
    <?php endif; ?>
    
    <div id="main-container">
    	
      <?php $meta = _WSH()->get_meta( '_bunch_header_settings' );
	  if(sigma_set( $meta, 'header_style' )) $header_style = sigma_set( $meta, 'header_style' ); else
	  $header_style = sigma_set($options, 'header_style', 'header_v1');
				

				if ( $header_style == 'header_v1') {
					get_template_part( 'includes/modules/header_v1' );
				}
				elseif ( $header_style == 'header_v2'  ) {
					get_template_part( 'includes/modules/header_v2' );
				} 
				elseif ( $header_style == 'header_v3'  ) { 
					get_template_part( 'includes/modules/header_v3' );
				}
				elseif ( $header_style == 'header_v4'  ) { 
					get_template_part( 'includes/modules/header_v4' );
				}
				elseif ( $header_style == 'header_v5'  ) { 
					get_template_part( 'includes/modules/header_v5' );
				}
				elseif ( $header_style == 'header_v6'  ) { 
					get_template_part( 'includes/modules/header_v6' );
				}
				
				else {
					get_template_part( 'includes/modules/header_v1' );
				}
    		
    ?>
 	