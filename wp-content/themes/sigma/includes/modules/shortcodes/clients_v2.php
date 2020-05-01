<section id="partners">

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

                <ul class="clients-list">
                	<?php foreach( $atts['clients'] as $key => $item ): ?>
                    <li><a href="<?php echo esc_url( $item->client_img );?>"><img src="<?php echo esc_url( $item->client_img );?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>"></a></li>
                    <?php endforeach;?>
                </ul>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

</section>