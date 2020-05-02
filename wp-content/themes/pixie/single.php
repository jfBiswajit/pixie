<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <div class="container">
      <h4><?php the_title() ?></h4>
      <p class="bg-light p-2">Author: <?php the_author_posts_link() ?>, At: <?php the_time() ?>, On: <?php the_time() ?> In: <?php echo get_the_category_list(',') ?></p>
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