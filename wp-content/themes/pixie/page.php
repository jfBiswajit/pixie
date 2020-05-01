<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <header class="p-2 text-light" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url(<?php echo get_theme_file_uri('img/nature_sunlight.jpg') ?>)">
      <h2><?php the_title() ?></h2>
      <h4>Subtitle goes here</h4>
    </header>
    <p><?php the_content() ?></p>
  <?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>