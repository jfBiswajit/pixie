<?php get_header() ?>
<div class="container">
  <header>
    <h1 class="text-center bg-info p-2"><?php bloginfo('name') ?> (<?php bloginfo('description') ?>)</h1>
  </header>
  <?php
  $LatestTwoPost = new WP_Query(array(
    'posts_per_page' => 2
  ))
  ?>

  <ul class="latest-2-post list-group mb-2">
    <li class="list-group-item text-center bg-danger text-light">Lastest Two Post (Custom Query)</li>
    <?php while ($LatestTwoPost->have_posts()) : $LatestTwoPost->the_post() ?>
      <li class="list-group-item"><span class="rounded-circle bg-warning d-inline-block p-2"><?php the_time('M') ?></span> <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
        <p><?php echo wp_trim_words(get_the_content(), 18) ?> <a href="<?php the_permalink() ?>">Continue</a></p>
      </li>
    <?php endwhile ?>
    <?php wp_reset_postdata() ?>
    <!--dont forget to reset-->
    <li class="list-group-item text-center bg-light"><a href="<?php echo site_url('/blog') ?>">All Post</a></li>
  </ul>
</div>
<?php get_footer() ?>