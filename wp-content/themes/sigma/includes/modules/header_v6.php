<?php $options = _WSH()->option();
sigma_bunch_global_variable(); ?>

<!-- HEADER -->
<header id="header">
	<?php if(sigma_set( $options, 'sticky_logo' )):?>
    <div class="sticky-logo" data-sticky-logo="<?php echo esc_attr( sigma_set( $options, 'sticky_logo' ) );?>"></div>
	<?php endif;?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- LOGO -->
				<div id="logo">
					<?php if(sigma_set($options, 'logo_image_v1')): ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(sigma_set($options, 'logo_image_v1')); ?>" data-default-image="<?php echo esc_url(sigma_set($options, 'logo_image_v1')); ?>" alt="<?php esc_attr_e('Logo', 'sigma'); ?>" title="<?php esc_attr_e('Arctica', 'sigma'); ?>"></a>
                    <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_template_directory_uri().'/images/logo.png'); ?>" alt="<?php esc_attr_e('Logo', 'sigma'); ?>"></a>
                    <?php endif; ?>
				</div><!-- LOGO -->
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- MENU -->
				<nav>
					<a class="mobile-menu-button waves" href="#"></a>
					<ul class="menu clearfix nav" id="menu">
						<?php wp_nav_menu( array( 'theme_location' => 'main_menu6', 'container_id' => 'navbar-collapse-1',
							'container_class'=>'navbar-collapse collapse navbar-right',
							'menu_class'=>'nav navbar-nav',
							'fallback_cb'=>false, 
							'items_wrap' => '%3$s', 
							'container'=>false,
							'depth'=>'3',
							'walker'=> new Bootstrap_walker()  
						) ); ?>
					</ul>
				</nav>
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->
</header><!-- HEADER -->
<div id="page-content">