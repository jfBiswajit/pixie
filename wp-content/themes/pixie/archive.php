<?php get_header() ?>
<div class="container">
  <div class="bg-light p-4 mb-2">
    <h3 class="text-success"><?php the_archive_title() ?></h3>
    <p class="text-muted"><?php the_archive_description() ?></p>
    <ul class="list-group">
      <?php while (have_posts()) : ?>
        <?php the_post() ?>
        <li class="list-group-item"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
      <?php endwhile ?>
    </ul>
  </div>
</div>
<?php get_footer() ?>