<?php get_header() ?>
<div class="container">
  <div class="row">
    <ul class="upcoming-events list-group mb-2 col">
      <li class="list-group-item text-center bg-light text-dark text-light">All Posts</li>
      <?php while (have_posts()) : the_post() ?>
        <li class="list-group-item"><span class="badge badge-danger"><?php the_time('M d') ?></span> <a class="text-primary" href="<?php the_permalink() ?>"><?php the_title() ?></a>
          <div class="mb-4 text-muted">(Author <?php the_author_posts_link() ?>) (at <?php the_time('h:i a') ?>) (on <?php the_time('d-M-y') ?>) (in <?php echo get_the_category_list(',') ?>)</div>
        </li>
      <?php endwhile ?>
      <?php wp_reset_postdata() ?>
      <!--dont forget to reset-->
    </ul>
  </div>
  <div class="bg-light p-2 mb-2 text-right">
    <?php echo paginate_links() ?>
  </div>
</div>
<?php get_footer() ?>