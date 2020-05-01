<?php $count = 1;
$query_args = array('post_type' => 'bunch_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['team_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section id="team">
<div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="headline text-center" style="margin-bottom:30px;">

                    <h2><?php echo wp_kses_post($title); ?></h2>
					<p><?php echo wp_kses_post($subtitle); ?></p>

                </div><!-- headline -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">

                <p class="text-center"><?php echo wp_kses_post($text); ?></p>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="owl-carousel team-members-slider">
        <?php while($query->have_posts()): $query->the_post();
		global $post;
		$team_meta = _WSH()->get_meta(); ?>
        <div class="item">

            <div class="team-member">
                <div class="team-member-thumb">

                    <?php the_post_thumbnail('sigma_480x550'); ?>

                    <div class="team-member-hover">

                        <div class="team-member-details">

                            <h4><?php the_title(); ?></h4>
							<p><?php echo wp_kses_post(sigma_set($team_meta, 'designation')); ?></p>

                        </div><!-- team-member-details -->
						
                        <?php if($socials = sigma_set($team_meta, 'bunch_team_social')): ?>
                            <div class="social-media bordered default-color">
                                <?php foreach($socials as $key => $value):?>
                                <a href="<?php echo esc_url(sigma_set($value, 'social_link')); ?>" target="_blank"><i class="fa <?php echo esc_attr(sigma_set($value, 'social_icon')); ?>"></i></a>
                                <?php endforeach; ?>
                            </div><!-- social-media -->
                        <?php endif; ?>

                    </div><!-- team-member-hover -->

                </div><!-- team-member-thumb -->
            </div><!-- team-member -->

        </div><!-- item -->
        <?php endwhile;?>
        
    </div><!-- team-members-slider -->

</section><!-- about -->

<?php endif; wp_reset_postdata(); ?>