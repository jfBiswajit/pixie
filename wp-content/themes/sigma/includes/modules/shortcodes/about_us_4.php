<section id="about">

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
            <div class="col-sm-6">

                <p class="text-center wow zoomIn"><img src="<?php echo esc_url( $img );?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>"></p>

            </div><!-- col -->
            <div class="col-sm-6">

                <br>

                <h5 class="text-uppercase"><?php echo wp_kses_post( $title1 );?></h5>

                <br>

                <p><?php echo wp_kses_post( $text1 );?></p>

                <br>

                <ul class="check-list">
                    
                    <?php $fearures = explode("\n",$feature_str);?>
					<?php foreach($fearures as $feature):?>
                	<li><?php echo wp_kses_post($feature);?></li>
                    <?php endforeach;?>
                    
                </ul>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
</section>    