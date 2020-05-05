<?php $parentID = wp_get_post_parent_id(get_the_ID()) ?>
<?php get_header() ?>
<div class="container">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
      <header class="p-2 text-light" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url(<?php echo get_field('page_banner_bg_image')['sizes']['page_banner'] ?>)">
        <h2><?php the_title() ?></h2>
        <h4><?php the_field('page_banner_subtitle') ?></h4>
      </header>
      <p class="container"><?php the_content() ?></p>
    <?php endwhile ?>
    <div class="p-2">
      <ul class="list-group">
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
      </ul>
    </div>
  <?php endif ?>
  <?php if ($parentID) : ?>
    <div class="p-1">
      <a class="disabled" href="<?php echo get_the_permalink($parentID) ?>"><?php echo get_the_title($parentID) ?></a> > <span href="<?php echo the_permalink() ?>"><?php the_title() ?></span>
    </div>
  <?php endif ?>
</div>
<?php get_footer() ?>