<?php
function custom_post_type()
{
  // Custom post type - Event
  register_post_type('event', array(
    'supports' => array('title', 'editor', 'excerpt'),
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true,
    'public' => true,
    'description' => 'Add new event from this menu',
    'menu_icon' => 'dashicons-calendar-alt',
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    )
  ));
  
  // Custom post type - Program
  register_post_type('program', array(
    'supports' => array('title', 'editor'),
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    'description' => 'Add new event from this menu',
    'menu_icon' => 'dashicons-awards',
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    )
  ));

  // Custom post type - Professor
  register_post_type('professor', array(
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'description' => 'Add new event from this menu',
    'menu_icon' => 'dashicons-welcome-learn-more',
    'labels' => array(
      'name' => 'professor',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All professor',
      'singular_name' => 'Professor'
    )
  ));
}

add_action('init', 'custom_post_type');
