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

                <p><img class="wow zoomIn" src="<?php echo esc_url( $img );?>" alt="<?php esc_attr_e('Awesome Image', 'sigma');?>"></p>

            </div><!-- col -->
            <div class="col-sm-6">
				
                <div class="panel-group" id="accordion1">
                	<?php foreach( $atts['accordian'] as $key => $item ): 
						
					?>
                    <div class="panel">
                        <div class="panel-heading">

                            <h6 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1-1<?php echo esc_attr($key);?>" aria-expanded="false" class="waves"><?php echo wp_kses_post($item->a_title); ?></a>
                            </h6>

                        </div><!-- panel-heading -->
                        <div id="collapse1-1<?php echo esc_attr($key);?>" class="panel-collapse collapse <?php if($key == 1) echo 'in';?>">
                            <div class="panel-body">

                                <p><?php echo wp_kses_post($item->a_text); ?></p>

                            </div><!-- panel-body -->
                        </div><!-- panel-collapse -->
                    </div><!-- panel -->
                    <?php endforeach;?>
                </div><!-- accordion -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
    
</section>    