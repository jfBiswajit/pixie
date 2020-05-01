<section id="pricing">

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
        	
			<?php foreach( $atts['price_plan'] as $key => $item ): ?>
            <div class="col-md-3 col-sm-6">

                <div class="price-plan style-2">
					<div class="price-plan-header">
                        <h4><?php echo wp_kses_post($item->plan_name); ?></h4>
                        <h1><sup><?php echo wp_kses_post($item->currency_sign); ?></sup> <?php echo wp_kses_post($item->amount); ?></h1>
                    </div><!-- price-plan-header -->

                    <ul>
                        <?php $fearures = explode("\n", ($item->text));
							foreach($fearures as $feature): ?>
							<li><?php echo wp_kses_post($feature); ?></li>
							<?php endforeach; ?>
                    </ul>

                    <div class="price-plan-footer">

                        <a class="btn btn-default-2 waves" href="<?php echo esc_url($item->btn_link); ?>"><?php echo wp_kses_post($item->btn_title); ?></a>

                    </div><!-- price-plan-footer -->

                </div><!-- price-plan -->

            </div><!-- col -->
            <?php endforeach; ?>
            
        </div><!-- row -->
    </div><!-- container -->

</section>
