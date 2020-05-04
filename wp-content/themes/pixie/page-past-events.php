<?php get_header() ?>
<div class="container">
  <div class="row">
    <ul class="upcoming-events list-group mb-2 col">
      <li class="list-group-item text-center bg-light text-dark text-light">Past Event</li>
      <?php
      $PastEvents = new WP_Query(array(
        'paged' => get_query_var('paged', 1),
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'event_date',
            'compare' => '<',
            'value' => date('Ymd'),
            'type' => 'numeric'
          )
        )
      ))
      ?>
      <?php while ($PastEvents->have_posts()) : $PastEvents->the_post() ?>
        <li class="list-group-item"><span class="badge badge-danger">
            <?php
            $date = new DateTime(get_field('event_date'));
            echo $date->format('M d');
            ?>
          </span> <a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a>
          <p><?php echo wp_trim_words(get_the_content(), 16) ?> <a href="<?php the_permalink() ?>">Continue</a></p>
        </li>
      <?php endwhile ?>
      <?php wp_reset_postdata() ?>
      <!--dont forget to reset-->
    </ul>
  </div>
  <div class="bg-light p-2 mb-2 text-right">
    <?php
      echo paginate_links(array(
        'total' => $PastEvents->max_num_pages
    ))
    ?>
  </div>
</div>
<?php get_footer() ?>