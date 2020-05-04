<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
  <header class="text-center mt-2">
    <h1 class="mb-0"><a href="<?php bloginfo('url') ?>"><?php bloginfo('name') ?></a></h1>
    <p class="m-0"><?php bloginfo('description') ?></p>
  </header>

  <nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center justify-content-center" id="navbarNav">
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