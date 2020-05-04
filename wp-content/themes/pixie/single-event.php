<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <div class="container">
      <h4><?php the_title() ?></h4>
      <div class="mb-4 text-muted"><?php the_time('d-M-y') ?></div>
      <div class="border p-2 mb-2">
        <?php the_content() ?>
      </div>
    </div>
  <?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>