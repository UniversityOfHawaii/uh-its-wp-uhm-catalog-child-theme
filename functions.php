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
 * add anchor links
 */
function uhm_catalog_setup() {
  require_once( get_stylesheet_directory() . '/lib/anchor-links/anchor-links.php' );
}
add_action( 'after_setup_theme', 'uhm_catalog_setup' );

/*
 * remove featured thumbnail support
 */
/*function uhm_catalog_child_setup()
{
    remove_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'uhm_catalog_child_setup', 11 );*/

// REGISTER NEW TAXONOMIES
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_group_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_group_taxonomies() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => _x( 'Academic Groups', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'Academic Group', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Academic Groups', 'textdomain' ),
    'all_items'         => __( 'All Academic Groups', 'textdomain' ),
    'parent_item'       => __( 'Parent Academic Group', 'textdomain' ),
    'parent_item_colon' => __( 'Parent Academic Group:', 'textdomain' ),
    'edit_item'         => __( 'Edit Academic Group', 'textdomain' ),
    'update_item'       => __( 'Update Academic Group', 'textdomain' ),
    'add_new_item'      => __( 'Add New Academic Group', 'textdomain' ),
    'new_item_name'     => __( 'New Academic Group', 'textdomain' ),
    'menu_name'         => __( 'Academic Group', 'textdomain' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'academic-group' ),
  );

  register_taxonomy( 'academic-groups', array( '' ), $args );

  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name'                       => _x( 'Course Tags', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'Course Tag', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search Course Tags', 'textdomain' ),
    'popular_items'              => __( 'Popular Course Tags', 'textdomain' ),
    'all_items'                  => __( 'All Course Tags', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit Course Tag', 'textdomain' ),
    'update_item'                => __( 'Update Course Tag', 'textdomain' ),
    'add_new_item'               => __( 'Add New Course Tag', 'textdomain' ),
    'new_item_name'              => __( 'New Course Tag', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate course tags with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove course tags', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used course tags', 'textdomain' ),
    'not_found'                  => __( 'No course tags found.', 'textdomain' ),
    'menu_name'                  => __( 'Course Tags', 'textdomain' ),
  );

  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'course-tag' ),
  );

  register_taxonomy( 'course-tags', '', $args );
}

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
      'taxonomies'    => array('post_tag', 'category', 'academic-groups', 'course-tags' ),
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

// add units & courses posts to category archive pages
function add_category_set_post_types( $query ){
    if( ($query->is_category() | $query->is_tag()) && $query->is_main_query() ){
        $query->set( 'post_type', array( 'post', 'units', 'courses' ) );
    }
}
add_action( 'pre_get_posts', 'add_category_set_post_types' );

?>