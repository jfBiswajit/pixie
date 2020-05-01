<?php $options = get_option('sigma'.'_theme_options'); ?>
</div>
	<div class="clearfix"></div>
    
    
	<!-- FOOTER -->
	<footer>
	<?php $meta = _WSH()->get_meta( '_bunch_header_settings' );
			
			if(sigma_set( $meta, 'footer_style' )) $footer_style = sigma_set( $meta, 'footer_style' ); else
			$footer_style = sigma_set($options, 'footer_style', 'footer_v1');
            
			if ( $footer_style == 'footer_v1') {
                get_template_part( 'includes/modules/footer_v1' );
            }
            elseif ( $footer_style == 'footer_v2'  ) {
                get_template_part( 'includes/modules/footer_v2' );
            } 
            elseif ( $footer_style == 'footer_v3'  ) { 
                get_template_part( 'includes/modules/footer_v3' );
            }
            
            else {
                get_template_part( 'includes/modules/footer_v1' );
            }
        
    ?>
	</footer><!-- FOOTER -->
</div>
<!--End pagewrapper-->
</div>
<!-- SCROLL UP -->
<a id="scroll-up" class="waves"><i class="fa fa-angle-up"></i></a>

<?php wp_footer(); ?>
</body>
</html>