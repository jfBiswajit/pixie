<?php

// Declare functions
function load_assets()
{
  wp_enqueue_script('app', get_theme_file_uri('test.js'), NULL, '1.0', true);
  wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
  wp_enqueue_style('main', get_stylesheet_uri());
}

function features()
{
  add_theme_support('title-tag');
  register_nav_menu('header_menu', 'Location - Header');
  register_nav_menu('footer_menu', 'Location - Footer');
}

function custom_query($query)
{
  if (!is_admin() && is_post_type_archive('program') && $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('post_per_page', -1);
  }

  if (!is_admin() && is_post_type_archive('event') && $query->is_main_query()) {
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => date('Ymd'),
        'type' => 'numeric'
      )
    ));
  }
}


// Call functions
add_action('wp_enqueue_scripts', 'load_assets');
add_action('after_setup_theme', 'features');
add_action('pre_get_posts', 'custom_query');




// Dump code
function add_menu_link_class($atts, $item, $args)
{
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}

function add_menu_list_item_class($classes, $item, $args)
{
  if (property_exists($args, 'list_item_class')) {
    $classes[] = $args->list_item_class;
  }
  return $classes;
}


add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);
