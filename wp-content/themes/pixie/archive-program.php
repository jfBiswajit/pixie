<?php get_header() ?>
<div class="container">
  <div class="row">
    <ul class="upcoming-events list-group mb-2 col">
      <li class="list-group-item text-center bg-light text-dark text-light">All Programs</li>
      <?php while (have_posts()) : the_post() ?>
        <li class="list-group-item"><a class="text-danger" href="<?php the_permalink() ?>"><?php the_title() ?></a>
        </li>
      <?php endwhile ?>
    </ul>
  </div>
  <?php if (paginate_links()) : ?>
    <div class="bg-light p-2 mb-2 text-right">
      <?php echo paginate_links() ?>
    </div>
  <?php endif ?>
</div>
<?php get_footer() ?>