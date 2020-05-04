<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <div class="container">
      <div class="list-group">
        <div class="list-group-item bg-light">
          <h4><?php the_title() ?></h4>
          <div class="mb-4 text-muted">(Author <?php the_author_posts_link() ?>) (at <?php the_time('h:i a') ?>) (on <?php the_time('d-M-y') ?>) (in <?php echo get_the_category_list(',') ?>)</div>
        </div>
        <div class="list-group-item">
          <?php the_content() ?>
        </div>
      </div>
    </div>
  <?php endwhile ?>
<?php endif ?>

<!-- Previous and Next Post -->
<?php if (is_single()) : ?>
  <div class="border rounded d-flex justify-content-between container p-3 my-2">
    <div><?php previous_post_link('%link', '%title'); ?></div>
    <div><?php next_post_link('%link', '%title'); ?></div>
  </div>
<?php endif; ?>

<?php get_footer() ?>