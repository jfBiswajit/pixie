<?php get_header() ?>
<div class="container">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
      <div class="card mb-2 p-2">
        <h4><a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
        <p>Author: <?php the_author_posts_link() ?>, At: <?php the_time() ?>, On: <?php the_time() ?> In: <?php echo get_the_category_list(',') ?></p>
      </div>
    <?php endwhile ?>
  <?php endif ?>
  <div class="bg-light p-2 mb-2 text-right">
    <?php echo paginate_links() ?>
  </div>
</div>
<?php get_footer() ?>