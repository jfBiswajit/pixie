<?php
function custom_post_type()
{
  register_post_type('event', array(
    'public' => true,
    'has_archive' => true,
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
}

add_action('init', 'custom_post_type');
