<div class="map-container">

    <div class="switch-button"><?php esc_html_e('Hide Map', 'sigma');?> <span></span> <?php esc_html_e('Show Map', 'sigma');?></div>

    <div class="map no-margin-bottom" data-zoom="<?php echo esc_attr( $zoom );?>" data-height="<?php echo esc_attr( $height );?>" data-address="<?php echo esc_attr( $address );?>"></div>

    <div class="map-overlay">
        <div class="map-overlay-content">
        	<div id="contact-form" class="cutom-class">
        	<?php echo do_shortcode($contact_shortcode);?>
            </div>

        </div><!-- map-overlay-content -->
    </div><!-- map-overlay -->

</div><!-- map-container -->
