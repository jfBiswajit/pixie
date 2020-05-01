<?php /* Template Name: Coming Soon Page */
	$options = _WSH()->option();
	get_header('coming_soon');
?>
<section class="full-section dark-section full-screen" id="section-6" style="background-image:url( <?php echo esc_url( sigma_set( $options, 'bg_img' ) );?> );">

    <div class="full-section-overlay-color"></div>

    <div class="full-section-container">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">

                    <p><img src="<?php echo esc_url( sigma_set( $options, 'logo_img' ) );?>" alt="<?php esc_attr_e('Sigma', 'sigma');?>"></p>

                    <br><br>

                    <h1><?php echo wp_kses_post( sigma_set( $options, 'title' ) );?></h1>
                    <p><?php echo wp_kses_post( sigma_set( $options, 'text' ) );?></p>

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="countdown"></div>

                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->

    </div><!-- full-section-container -->
</section>
<?php get_footer('coming_soon'); ?>