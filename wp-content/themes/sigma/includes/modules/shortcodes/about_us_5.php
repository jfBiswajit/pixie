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

                <div class="panel-group" id="accordion1">
                    <?php foreach( $atts['accordian'] as $key => $item ): ?>
                    <div class="panel">
                        <div class="panel-heading">

                            <h6 class="panel-title">
                                <a class="waves" data-toggle="collapse" data-parent="#accordion1" href="#collapse1-1<?php echo esc_attr($key);?>"><?php echo wp_kses_post($item->a_title); ?></a>
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
            <div class="col-sm-6">
				<?php foreach( $atts['about_skills'] as $key => $item ): ?>
                <div class="progress-bar-title"><?php echo wp_kses_post($item->title); ?></div>
                <div class="progress">
                    <div class="progress-bar" data-width="<?php echo wp_kses_post($item->skills); ?>">
                        <span><?php echo wp_kses_post($item->skills); ?><?php esc_html_e('%', 'sigma'); ?></span>
                    </div><!-- progress-bar -->
                </div><!-- progress -->
                <?php endforeach; ?>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

</section>