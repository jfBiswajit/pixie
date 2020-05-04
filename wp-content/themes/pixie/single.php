<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <div class="container">
      <h4><?php the_title() ?></h4>
      <div class="mb-4 text-muted">(Author <?php the_author_posts_link() ?>) (at <?php the_time('h:i a') ?>) (on <?php the_time('d-M-y') ?>) (in <?php echo get_the_category_list(',') ?>)</div>
      <div class="border p-2 mb-2">
        <?php the_content() ?>
      </div>
    </div>
  <?php endwhile ?>
<?php endif ?>

<!-- Previous and Next Post -->
<?php if (is_single()) : ?>
  <div class="bg-light d-flex justify-content-between container p-2 mb-2">
    <div><?php previous_post_link('%link', '%title'); ?></div>
    <div><?php next_post_link('%link', '%title'); ?></div>
  </div>
<?php endif; ?>

<?php get_footer() ?>