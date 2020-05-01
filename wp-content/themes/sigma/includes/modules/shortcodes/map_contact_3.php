<section id="contact" <?php if($style_two == 'option_1'):?>style="background-image:url( '<?php echo esc_url( $bg_img );?>' );"<?php endif;?>>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="headline text-center">

                    <h2><?php echo wp_kses_post($title); ?></h2>
					<p><?php echo wp_kses_post($text); ?></p>

                </div><!-- headline -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="map" data-zoom="<?php echo esc_attr( $zoom );?>" data-height="<?php echo esc_attr( $height );?>" data-address="<?php echo esc_attr( $map_address );?>" data-address-details="<?php echo esc_attr( $map_title );?>"></div>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <br>

    <div class="container">
        <div class="row">
            <div class="col-sm-8">

                <h5 class="text-uppercase"><?php echo wp_kses_post( $contact_title );?></h5>

                <div id="contact-form">
                	<?php echo do_shortcode($contact_shortcode);?>
                </div>

            </div><!-- col -->
            <div class="col-sm-4">

                <h5 class="text-uppercase"><?php echo wp_kses_post( $title1 );?></h5>

                <br>

                <p><?php echo wp_kses_post( $contact_text );?></p>

                <br>

                <div class="widget-contact no-margin-bottom">

                    <ul>
                    	<?php if( $address ):?>
                        <li>
                            <i class="sigma-icon-placeholder-1"></i>
                            <?php echo wp_kses_post( $address );?>
                        </li>
                        <?php endif;?>
                        
                        <?php if( $phone ):?>
                        <li>
                            <i class="sigma-icon-telephone-call"></i>
                            <?php echo wp_kses_post( $phone );?>
                        </li>
                        <?php endif;?>
                        
                        <?php if( $email ):?>
                        <li>
                            <i class="sigma-icon-envelope-4"></i>
                            <a href="mailto:<?php echo sanitize_email( $email );?>"><?php echo sanitize_email( $email );?></a>
                        </li>
                        <?php endif;?>
                    </ul>

                </div><!-- widget-contact -->

                <br><br>

                <div class="widget widget-social">
					
                    <div class="social-media">
						<?php sigma_get_social_icons();?>
					</div><!-- social-media -->

                </div><!-- widget-social -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

</section><!-- contact -->
