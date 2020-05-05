<?php get_header() ?>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post() ?>
    <div class="container">
      <div class="list-group">
        <div class="list-group-item bg-light">
          <h4><?php the_title() ?></h4>
        </div>
        <div class="list-group-item border p-3 mb-2">
          <div class="row">
            <div class="col-2"><a href="<?php the_post_thumbnail_url() ?>"><?php the_post_thumbnail() ?></a></div>
            <div class="col-10"><?php the_content() ?></div>
          </div>
        </div>
      </div>
      <?php $RelatedPrograms = get_field('related_program'); ?>
      <?php if ($RelatedPrograms) : ?>
        <div class="my-2">
          <h4 class="bg-light p-2">Subject Thought</h4>
          <ul class="list-group">
            <?php foreach ($RelatedPrograms as $programs) : ?>
              <li class="list-group-item"><a class="text-danger" href="<?php echo get_the_permalink($programs) ?>"><?php echo get_the_title($programs) ?></a></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>
    </div>
  <?php endwhile ?>
<?php endif ?>
<?php get_footer() ?>