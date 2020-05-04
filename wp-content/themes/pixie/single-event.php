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
    </div>
  <?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>