<?php $options = _WSH()->option();
sigma_bunch_global_variable(); ?>

<?php if ( is_active_sidebar( 'footer-sidebar' ) ) { ?>
<div id="footer">
    <div class="container">
        <div class="row">
            <?php dynamic_sidebar( 'footer-sidebar' ); ?>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- footer -->
<?php } ?>

<div id="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="widget widget-text">
					<div>
						<p><small><?php echo wp_kses_post(sigma_set($options, 'footer_copyrights')); ?></small></p>
					</div>
				</div><!-- widget-text -->
			</div><!-- col -->
            
			<div class="col-sm-6">
            	<?php if(sigma_set($options, 'footer_social_v5')):
				if(sigma_set( $options, 'social_media' ) && is_array( sigma_set( $options, 'social_media' ) )): ?>
				<div class="widget widget-social">
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
</div><!-- footer-bottom-->
