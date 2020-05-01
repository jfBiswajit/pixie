<?php
// Declare functions
function load_assets() {
  wp_enqueue_script('app', get_theme_file_uri('test.js'));
  wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
  wp_enqueue_style('main', get_stylesheet_uri());
}

function title() {
  add_theme_support('title-tag');
}

// Call functions
add_action('wp_enqueue_scripts', 'load_assets');
add_action('after_setup_theme', 'title');