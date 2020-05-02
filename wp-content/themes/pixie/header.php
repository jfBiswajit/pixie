<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
  <nav class="navbar navbar-expand-md navbar-light bg-light mb-2">
    <a class="navbar-brand" href="<?php echo site_url() ?>">Pixie</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <?php 
          wp_nav_menu([
            'theme_location' => 'header_menu',
            'menu_class'    => 'navbar-nav',
            'list_item_class'  => 'nav-item',
            'link_class'   => 'nav-link'
          ]);
        ?>
    </div>
  </nav>