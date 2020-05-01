<?php $options = _WSH()->option();
sigma_bunch_global_variable(); ?>

<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
            	<?php if(sigma_set($options, 'footer_logo_v4')): ?>
				<div class="widget widget-text text-center">
					<div>
						<p><img src="<?php echo esc_url(sigma_set($options, 'footer_logo_v4')); ?>" alt="<?php esc_attr_e('Awesome Image', 'sigma'); ?>"></p>
					</div>
				</div><!-- widget-text -->
                <?php endif; ?>
				<div class="widget-contact m-b70 text-center">
					<ul>
                    	<?php if(sigma_set($options, 'footer_address_v4')): ?>
						<li><?php echo wp_kses_post(sigma_set($options, 'footer_address_v4')); ?></li>
                        <?php endif; if(sigma_set($options, 'footer_phone_v4')): ?>
						<li><?php echo wp_kses_post(sigma_set($options, 'footer_phone_v4')); ?></li>
                        <?php endif; if(sigma_set($options, 'footer_email_v4')): ?>
						<li><a href="mailto:<?php echo sanitize_email(sigma_set($options, 'footer_email_v4')); ?>"><?php echo sanitize_email(sigma_set($options, 'footer_email_v4')); ?></a></li>
                        <?php endif; ?>
					</ul>
				</div><!-- widget-contact -->
                
                <?php if(sigma_set($options, 'footer_social_v4')):
				if(sigma_set( $options, 'social_media' ) && is_array( sigma_set( $options, 'social_media' ) )): ?>
				<div class="widget-social text-center no-margin-bottom">
					<div class="social-media">
                    	<?php $social_icons = sigma_set( $options, 'social_media' );
                    	foreach( sigma_set( $social_icons, 'social_media' ) as $social_icon ):
						if( isset( $social_icon['tocopy' ] ) ) continue; ?>
						<a href="<?php echo esc_url(sigma_set( $social_icon, 'social_link')); ?>" class="<?php echo esc_attr(sigma_set( $social_icon, 'social_class')); ?>" target="_blank"><i class="fa <?php echo esc_attr(sigma_set( $social_icon, 'social_icon')); ?>"></i></a>
						<?php endforeach; ?>
					</div><!-- social-media -->
				</div><!-- widget-social -->
                <?php endif; endif; ?>
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->
</div><!-- footer-bottom -->

<div id="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="widget widget-text">
					<div>
						<p class="text-center"><small><?php echo wp_kses_post(sigma_set($options, 'footer_copyrights')); ?></small></p>
					</div>
				</div><!-- widget-text -->
			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->
</div><!-- footer-bottom -->
