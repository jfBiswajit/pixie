<div class="container">
    <div class="row">
        <div class="col-sm-12">
			<div class="owl-carousel images-slider">
                <?php foreach( $atts['slider'] as $key => $item ): ?>
                <div class="item">
                    <img src="<?php echo esc_url($item->slide_img); ?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>">
                </div><!-- item -->
                <?php endforeach;?>
			</div><!-- images-slider -->
		</div><!-- col -->
    </div><!-- row -->
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-8">

            <div class="row">
                <div class="col-sm-6">

                    <h5 class="text-uppercase"><?php echo wp_kses_post( $title );?></h5>

                    <br class="visible-block-xs visible-block-sm">

                </div><!-- col -->
                <div class="col-sm-6">

                    <div class="social-media rounded text-right hidden-xs hidden-sm">
						<strong class="text-uppercase"><?php esc_html_e('Share on:', 'sigma');?> </strong>
						<?php foreach( $atts['share'] as $key => $item ): ?>
                        <a href="<?php esc_url( $item->link );?>"><i class="fa <?php echo esc_attr( $item->icon );?>"></i></a>
                        <?php endforeach;?>
                    </div><!-- social-media -->

                </div><!-- col -->
            </div><!-- row -->
			<?php echo wp_kses_post( $text );?>

        </div><!-- col -->
        <div class="col-sm-4">

            <h5 class="text-uppercase"><?php echo wp_kses_post( $title1 );?></h5>

            <br>

            <ul class="project-details">
            	<?php echo wp_kses_post( $editor );?>
            </ul>

        </div><!-- col -->
    </div><!-- row -->
</div>