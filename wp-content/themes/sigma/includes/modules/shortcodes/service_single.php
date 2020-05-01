<!--Sidebar Page Container-->

<div class="sidebar-page-container service-single">

    <div class="auto-container">

        <div class="row clearfix">

            

            <!--Sidebar Side-->

            <div class="sidebar-side col-lg-3 col-md-4 col-sm-6 col-xs-12">

                <aside class="sidebar">

                    

                    <?php if ( is_active_sidebar( $sidebar_slug ) ) : ?>

						<?php dynamic_sidebar( $sidebar_slug ); ?>

                	<?php endif; ?>

                    

                </aside>

            </div>

            

            <!--Content Side-->

            <div class="content-side col-lg-9 col-md-8 col-sm-12 col-xs-12">

                <div class="services-single">

                    <div class="inner-service">

                        <!--Image-->

                        <div class="single-image">

                            <img src="<?php echo esc_url($image); ?>" alt="<?php esc_attr_e( 'Awesome Image', 'sigma' );?>" />

                        </div>

                        <h2><?php echo wp_kses_post($title); ?></h2>

                        <div class="text">

                            <?php echo wp_kses_post($text); ?>

                            

                            <?php if($project_img): ?>

                                <!--Two Column-->

                                <div class="two-column">

                                    <div class="row clearfix">

                                        <!--Content Column-->

                                        <div class="content-column col-md-7 col-sm-7 col-xs-12">

                                            <div class="inner-column no-padd-left">

                                                <h2><?php echo wp_kses_post($title1); ?></h2>

                                                <p><?php echo wp_kses_post($text1); ?></p>

                                                <ul class="check-list">

                                                    <?php $fearures = explode("\n", ($feature_str));?>

                                                    <?php foreach($fearures as $feature):?>

                                                        <li><?php echo wp_kses_post($feature ); ?></li>

                                                    <?php endforeach;?>

                                                </ul>

                                            </div>

                                        </div>

                                        <!--Image Column-->

                                        <div class="image-column col-md-5 col-sm-5 col-xs-12">

                                            <div class="image">

                                                <img src="<?php echo esc_url($project_img); ?>" alt="<?php esc_attr_e( 'Awesome Image', 'sigma' );?>" />

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            <?php endif; ?>

                            

                            <?php if($services):?>

                                <!--Featured Blocks-->

                                <div class="featured-blocks">

                                    <div class="clearfix">

                                    	<?php foreach( $atts['services'] as $key => $item ): ?>

                                            <!--Featured Block-->

                                            <div class="featured-block col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                                <div class="inner-box">

                                                    <div class="icon-box">

                                                        <span class="icon <?php echo esc_attr($item->icons); ?>"></span>

                                                    </div>

                                                    <h3><a href="<?php echo esc_url($item->ser_link); ?>"><?php echo wp_kses_post($item->ser_title1); ?></a></h3>

                                                    <div class="text"><?php echo wp_kses_post($item->ser_text); ?></div>

                                                </div>

                                            </div>

                                        <?php endforeach;?>

                                    </div>

                                </div>

                            <?php endif; ?>

                            

                            <?php if($title2):?>

                            	<h2><?php echo wp_kses_post($title2); ?></h2>

                                <p><?php echo wp_kses_post($text2); ?></p>

                            

                                <div class="row clearfix">

                                    <div class="column col-md-6 col-sm-6 col-xs-12">

                                        <ul class="check-list">

                                            <?php $fearures2 = explode("\n", ($feature_str2));?>

                                            <?php foreach($fearures2 as $feature2):?>

                                                <li><?php echo wp_kses_post($feature2 ); ?></li>

                                            <?php endforeach;?>

                                        </ul>

                                    </div>

                                    <div class="column col-md-6 col-sm-6 col-xs-12">

                                        <ul class="check-list">

                                            <?php $fearures3 = explode("\n", ($feature_str3));?>

                                            <?php foreach($fearures3 as $feature3):?>

                                                <li><?php echo wp_kses_post($feature3 ); ?></li>

                                            <?php endforeach;?>

                                        </ul>

                                    </div>

                                </div>

                            <?php endif; ?>

                            

                            <?php if($upper_title):?>

                                <!--Agent Box-->

                                <div class="agent-box">

                                    <div class="inner-agent">

                                        <div class="clearfix">

                                            <div class="pull-left">

                                                <div class="agent-title"><?php echo wp_kses_post($upper_title); ?> </div>

                                                <h3><?php echo wp_kses_post($title3); ?></h3>

                                            </div>

                                            <div class="pull-right">

                                                <a href="<?php echo esc_url($btn_link); ?>" class="theme-btn btn btn-default-2 waves"><?php echo wp_kses_post($btn_title); ?></a>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

            

        </div>

    </div>

</div>

<!--End Services Section Three-->