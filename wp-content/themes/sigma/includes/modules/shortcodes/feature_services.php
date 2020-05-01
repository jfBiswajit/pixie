<section id="features">

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

                <div class="tabs">

                    <ul class="nav nav-tabs">
                        <?php foreach( $atts['tab'] as $key => $item ): ?>
                        <li class="<?php if($key == 1) echo 'active';?>"><a class="waves" href="#tab-1-1<?php echo esc_attr($key);?>" data-toggle="tab"><?php echo wp_kses_post($item->t_title); ?></a></li>
                        <?php endforeach;?>
                    </ul>

                    <div class="tab-content">
                        <?php foreach( $atts['tab'] as $key => $item ): ?>
                        <div class="tab-pane fade <?php if($key == 1) echo 'active in';?>" id="tab-1-1<?php echo esc_attr($key);?>">

                            <h3 class="text-uppercase"><?php echo wp_kses_post($item->title1); ?></h3>

                            <br>

                            <p><?php echo wp_kses_post($item->t_text); ?></p>

                            <br>

                            <img src="<?php echo esc_url( $item->img );?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>">

                        </div>
                        <?php endforeach;?>
                    </div><!-- tab-content -->

                </div><!-- tabs -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

</section><!-- features -->
