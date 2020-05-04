<?php get_header() ?>
<div class="container">
  <div class="row">
    <ul class="latest-2-post list-group mb-2 col">
      <?php
      $LatestTwoPost = new WP_Query(array(
        'posts_per_page' => 2
      ))
      ?>
      <li class="list-group-item text-center bg-info text-light">Recent Post (Custom Query)</li>
      <?php while ($LatestTwoPost->have_posts()) : $LatestTwoPost->the_post() ?>
        <li class="list-group-item"><span class="badge badge-danger"><?php the_time('M d') ?></span> <a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a>
          <p><?php echo wp_trim_words(get_the_content(), 18) ?> <a href="<?php the_permalink() ?>">Continue</a></p>
        </li>
      <?php endwhile ?>
      <?php wp_reset_postdata() ?>
      <!--dont forget to reset-->
      <li class="list-group-item text-center bg-light"><a href="<?php echo site_url('/blog') ?>">All Post</a></li>
    </ul>

    <ul class="upcoming-events list-group mb-2 col">
      <?php
      $LatestEvents = new WP_Query(array(
        'posts_per_page' => 2,
        'post_type' => 'event'
      ))
      ?>
      <li class="list-group-item text-center bg-success text-light">Upcoming Event</li>
      <?php while ($LatestEvents->have_posts()) : $LatestEvents->the_post() ?>
        <li class="list-group-item"><span class="badge badge-danger"><?php the_time('M d') ?></span> <a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a>
          <p><?php echo wp_trim_words(get_the_content(), 16) ?> <a href="<?php the_permalink() ?>">Continue</a></p>
        </li>
      <?php endwhile ?>
      <?php wp_reset_postdata() ?>
      <!--dont forget to reset-->
      <li class="list-group-item text-center bg-light"><a href="<?php echo site_url('/blog') ?>">All Post</a></li>
    </ul>
  </div>
</div>
<?php get_footer() ?>