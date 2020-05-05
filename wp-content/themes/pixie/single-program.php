<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <div class="container">
      <div class="list-group">
        <div class="list-group-item bg-light">
          <h4><?php the_title() ?></h4>
          <div class="mb-4 text-muted"><?php the_time('d-M-y') ?></div>
        </div>
        <div class="list-group-item border p-3 mb-2">
          <?php the_content() ?>
        </div>
      </div>

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
          ),
          array(
            'key' => 'related_program',
            'compare' => 'LIKE',
            'value' => '"' . get_the_ID() . '"'
          )
        )
      ))
      ?>

      <?php if ($LatestEvents->have_posts()) : ?>
        <ul class="upcoming-events list-group mb-2 col">
          <li class="list-group-item text-center bg-success text-light">Upcoming <?php the_title() ?> Event</li>
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
        </ul>
      <?php endif ?>
      <?php wp_reset_postdata() ?>
      <!--dont forget to reset-->
    </div>
  <?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>