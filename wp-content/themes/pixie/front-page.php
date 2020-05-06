<?php get_header() ?>
<div class="container">
  <div class="row">
    <ul class="latest-2-post list-group mb-2 col">
      <?php
      $LatestTwoPost = new WP_Query(array(
        'posts_per_page' => 3
      ))
      ?>
      <li class="list-group-item text-center bg-info text-light">Recent Post (Custom Query)</li>
      <?php while ($LatestTwoPost->have_posts()) : $LatestTwoPost->the_post() ?>
        <li class="list-group-item"><span class="badge badge-info"><?php the_time('M d') ?></span> <a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a>
          <p>
            <?php if (has_excerpt()) : ?>
              <?php echo get_the_excerpt() ?>
              <a href="<?php the_permalink() ?>">Continue</a>
            <?php else : ?>
              <?php echo wp_trim_words(get_the_content(), 18) ?> <a href="<?php the_permalink() ?>">Continue</a>
            <?php endif ?>
          </p>
        </li>
      <?php endwhile ?>
      <?php wp_reset_postdata() ?>
      <!--dont forget to reset-->
      <li class="list-group-item text-center bg-light"><a href="<?php echo site_url('/blog') ?>">All Post</a></li>
    </ul>

    <ul class="upcoming-events list-group mb-2 col">
      <?php
      $LatestEvents = new WP_Query(array(
        'posts_per_page' => 3,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => date('Ymd'),
            'type' => 'numeric'
          )
        )
      ))
      ?>
      <li class="list-group-item text-center bg-success text-light">Upcoming Event</li>
      <?php while ($LatestEvents->have_posts()) : $LatestEvents->the_post() ?>
        <li class="list-group-item"><span class="badge badge-success">
            <?php
            $date = new DateTime(get_field('event_date'));
            echo $date->format('M d');
            ?>
          </span> <a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a>
          <p><?php if (has_excerpt()) : ?>
              <?php echo get_the_excerpt() ?>
              <a href="<?php the_permalink() ?>">Continue</a>
            <?php else : ?>
              <?php echo wp_trim_words(get_the_content(), 18) ?> <a href="<?php the_permalink() ?>">Continue</a>
            <?php endif ?></p>
        </li>
      <?php endwhile ?>
      <?php wp_reset_postdata() ?>
      <!--dont forget to reset-->
      <li class="list-group-item text-center bg-light"><a href="<?php echo get_post_type_archive_link('event') ?>">All Post</a></li>
    </ul>
  </div>
  <?php get_template_part('template/test') ?>
</div>
<?php get_footer() ?>