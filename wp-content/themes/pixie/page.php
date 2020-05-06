<?php $parentID = wp_get_post_parent_id(get_the_ID()) ?>
<?php get_header() ?>
<div class="container">
  <ul class="list-group">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post() ?>
        <?php pageBannerTemp() ?>
        <li class="list-group-item"><?php the_content() ?></li>
      <?php endwhile ?>
      <div class="p-2">
          <li class="page_item"><?php echo get_the_title($parentID) ?></li>
          <?php if ($parentID) : ?>
            <?php $parent = $parentID ?>
          <?php else : ?>
            <?php $parent = get_the_ID() ?>
          <?php endif ?>

          <?php wp_list_pages(array(
            'title_li' => null,
            'child_of' => $parent
          )) ?>
      </div>
    <?php endif ?>
    <?php if ($parentID) : ?>
      <div class="p-1">
        <a class="disabled" href="<?php echo get_the_permalink($parentID) ?>"><?php echo get_the_title($parentID) ?></a> > <span href="<?php echo the_permalink() ?>"><?php the_title() ?></span>
      </div>
    <?php endif ?>
  </ul>
</div>
<?php get_footer() ?>