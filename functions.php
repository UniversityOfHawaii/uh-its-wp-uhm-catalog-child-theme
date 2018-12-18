<?php
/**
 * UHM Catalog - Manoa 2018 Child Theme
 *
 */

/*
 * enqueue stylesheets
 */
function uhm_catalog_enqueue_styles() {

  $parent_style = 'manoa2018_style';

  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'uhm_catalog_style',
    get_stylesheet_directory_uri() . '/style.css',
    array( $parent_style ),
    wp_get_theme()->get('Version')
  );
}
add_action( 'wp_enqueue_scripts', 'uhm_catalog_enqueue_styles' );

/*
 * register custom post types
 */
//create custom post types
function uhm_catalog_create_custom_post_types()
{
  register_post_type(

    'courses',
    // Options
    array(
      'labels' => array(
        'name' => __('Courses'),
        'singular_name' => __('Course'),
        'menu_name'             => __('Courses', 'uhm_catalog'),
        'name_admin_bar'        => __('Course', 'uhm_catalog'),
        'archives'              => __('Course Archives', 'uhm_catalog'),
        'attributes'            => __('Course Attributes', 'uhm_catalog'),
        'parent_item_colon'     => __('Parent Item:', 'uhm_catalog'),
        'all_items'             => __('All Courses', 'uhm_catalog'),
        'add_new_item'          => __('Add New Course', 'uhm_catalog'),
        'add_new'               => __('Add New', 'uhm_catalog'),
        'new_item'              => __('New Course', 'uhm_catalog'),
        'edit_item'             => __('Edit Course', 'uhm_catalog'),
        'update_item'           => __('Update Course', 'uhm_catalog'),
        'view_item'             => __('View Course', 'uhm_catalog'),
        'view_items'            => __('View Courses', 'uhm_catalog'),
        'search_items'          => __('Search Course', 'uhm_catalog'),
        'not_found'             => __('Not found', 'uhm_catalog'),
        'not_found_in_trash'    => __('Not found in Trash', 'uhm_catalog'),
        'featured_image'        => __('Featured Image', 'uhm_catalog'),
        'set_featured_image'    => __('Set featured image', 'uhm_catalog'),
        'remove_featured_image' => __('Remove featured image', 'uhm_catalog'),
        'use_featured_image'    => __('Use as featured image', 'uhm_catalog'),
        'insert_into_item'      => __('Insert into Course', 'uhm_catalog'),
        'uploaded_to_this_item' => __('Uploaded to this Course', 'uhm_catalog'),
        'items_list'            => __('Courses list', 'uhm_catalog'),
        'items_list_navigation' => __('Courses list navigation', 'uhm_catalog'),
        'filter_items_list'     => __('Filter Courses list', 'uhm_catalog'),
      ),
      'label'         => __('Courses', 'uhm_catalog'),
      'description'   => __('The post for a Course', 'uhm_catalog'),
      'public'        => true,
      'has_archive'   => true,
      'rewrite'       => array('slug' => 'courses'),
      'show_in_rest'  => true,
      'taxonomies'    => array('post_tag', 'category' ),
      'supports'      => array('title', 'editor', 'author', 'revisions','custom-fields','page-attributes'),
      'menu_icon'     => 'dashicons-book-alt',
    )
  );
  register_post_type(
    'units',
    // Options
    array(
      'labels' => array(
        'name' => __('Units'),
        'singular_name' => __('Unit'),
        'menu_name'             => __('Colleges, Schools & Units', 'uhm_catalog'),
        'name_admin_bar'        => __('Colleges, Schools & Units', 'uhm_catalog'),
        'archives'              => __('College, School & Unit Archives', 'uhm_catalog'),
        'attributes'            => __('Unit Attributes', 'uhm_catalog'),
        'parent_item_colon'     => __('Parent Item:', 'uhm_catalog'),
        'all_items'             => __('All Colleges, Schools & Units', 'uhm_catalog'),
        'add_new_item'          => __('Add New College, School or Unit', 'uhm_catalog'),
        'add_new'               => __('Add New College, School or Unit', 'uhm_catalog'),
        'new_item'              => __('New College, School or Unit', 'uhm_catalog'),
        'edit_item'             => __('Edit College, School or Unit', 'uhm_catalog'),
        'update_item'           => __('Update College, School or Unit', 'uhm_catalog'),
        'view_item'             => __('View College, School or Unit', 'uhm_catalog'),
        'view_items'            => __('View Colleges, Schools & Units', 'uhm_catalog'),
        'search_items'          => __('Search College, School or Unit', 'uhm_catalog'),
        'not_found'             => __('Not found', 'uhm_catalog'),
        'not_found_in_trash'    => __('Not found in Trash', 'uhm_catalog'),
        'featured_image'        => __('Featured Image', 'uhm_catalog'),
        'set_featured_image'    => __('Set featured image', 'uhm_catalog'),
        'remove_featured_image' => __('Remove featured image', 'uhm_catalog'),
        'use_featured_image'    => __('Use as featured image', 'uhm_catalog'),
        'insert_into_item'      => __('Insert into College, School or Unit', 'uhm_catalog'),
        'uploaded_to_this_item' => __('Uploaded to this College, School or Unit', 'uhm_catalog'),
        'items_list'            => __('Colleges, Schools & Units list', 'uhm_catalog'),
        'items_list_navigation' => __('Colleges, Schools & Units list navigation', 'uhm_catalog'),
        'filter_items_list'     => __('Filter Colleges, Schools & Units list', 'uhm_catalog'),
      ),
      'label'         => __('Colleges, Schools & Units', 'uhm_catalog'),
      'description'   => __('A College, School or Academic Unit at the University of Hawaii at Manoa', 'uhm_catalog'),
      'public'        => true,
      'has_archive'   => true,
      'rewrite'       => array('slug' => 'units'),
      'show_in_rest'  => true,
      'supports'      => array('title', 'editor', 'author', 'revisions','custom-fields','page-attributes'),
      'taxonomies'    => array('post_tag', 'category' ),
      'menu_icon'     => 'dashicons-welcome-learn-more',
    )
  );
}
add_action('init','uhm_catalog_create_custom_post_types');

?>