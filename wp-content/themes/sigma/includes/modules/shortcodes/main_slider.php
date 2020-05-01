<div class="main-slider-container">
    <div class="owl-carousel main-slider">
        
        <?php foreach( $atts['main_slider'] as $key => $item ): ?>
        
        <div class="item" style="background-image:url('<?php echo esc_url( $item->slide_img );?>');">

            <div class="slide-description">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">

                            <h1><?php echo wp_kses_post( $item->title );?></h1>

                            <p><?php echo wp_kses_post( $item->text );?></p>

                            <a class="btn btn-default-1 waves" href="<?php echo esc_url( $item->btn_link );?>"><?php echo wp_kses_post( $item->btn_title );?></a>

                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- container -->

            </div><!-- slider-description -->

        </div><!-- item -->
        
        <?php endforeach;?>
        
    </div><!-- main-slider -->
</div><!-- main-slider-container -->