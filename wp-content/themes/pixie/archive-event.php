<?php get_header() ?>
<div class="container">
  <div class="row">
    <ul class="upcoming-events list-group mb-2 col">
      <li class="list-group-item text-center bg-light text-dark text-light">Upcoming Event (<a href="<?php echo site_url('past-events') ?>">Past</a>)</li>
      <?php while (have_posts()) : the_post() ?>
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
    <?php echo paginate_links() ?>
  </div>
</div>
<?php get_footer() ?>