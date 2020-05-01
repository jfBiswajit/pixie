<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <div class="card m-2 p-2">
      <h4><a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
      <p><?php the_content() ?></p>
    </div>
  <?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>
