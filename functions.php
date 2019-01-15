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
function uhm_catalog_enqueue_scripts() {
  if( is_page_template('page-anchors.php') || is_page_template('page-academic-group.php') ){
    include( get_stylesheet_directory() . '/lib/anchor-links/anchor-links.php' );
  }
}
add_action( 'wp_enqueue_scripts', 'uhm_catalog_enqueue_scripts' );

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
  /*$labels = array(
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

  register_taxonomy( 'academic-groups', array( '' ), $args );*/

  // Add new course tags taxonomy, NOT hierarchical (like tags)
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

  // Add new gen ed taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name'                       => _x( 'General Education', 'taxonomy general name', 'textdomain' ),
    'singular_name'              => _x( 'General Education', 'taxonomy singular name', 'textdomain' ),
    'search_items'               => __( 'Search General Education Tags', 'textdomain' ),
    'popular_items'              => __( 'Popular General Education Tags', 'textdomain' ),
    'all_items'                  => __( 'All General Education Tags', 'textdomain' ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit General Education Tag', 'textdomain' ),
    'update_item'                => __( 'Update General Education Tag', 'textdomain' ),
    'add_new_item'               => __( 'Add New General Education Tag', 'textdomain' ),
    'new_item_name'              => __( 'New General Education Tag', 'textdomain' ),
    'separate_items_with_commas' => __( 'Separate General Education tags with commas', 'textdomain' ),
    'add_or_remove_items'        => __( 'Add or remove General Education tags', 'textdomain' ),
    'choose_from_most_used'      => __( 'Choose from the most used General Education tags', 'textdomain' ),
    'not_found'                  => __( 'No General Education tags found.', 'textdomain' ),
    'menu_name'                  => __( 'General Education Tags', 'textdomain' ),
  );

  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'gened-tag' ),
  );

  register_taxonomy( 'gened-tags', '', $args );
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
      'taxonomies'    => array('post_tag', 'category', 'academic-groups', 'course-tags','gened-tags' ),
      'supports'      => array('title', 'editor', 'author', 'revisions','page-attributes'),
      'menu_icon'     => 'dashicons-book-alt',
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

// add section to customizer
function uhm_catalog_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'header_image' , array(
        'title'      => __( 'Header Background Image', 'mytheme' ),
    ) );
    // Add Homepage links
    $wp_customize->add_section( 'home-links' , array(
        'title' => __( 'Home Links', 'manoa2018' ),
        'description' => __( 'Insert the link titles and URL for the homepage. These will appear below the main catalog graphic.', 'manoa2018' )
    ) );
    // Add Home links
    $wp_customize->add_setting( 'home-link-1' , array( 'default' => '' ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home-link-1', array(
        'label' => __( 'Home Link 1 Text', 'manoa2018' ),
        'section' => 'home-links',
        'settings' => 'home-link-1',
    ) ) );
    $wp_customize->add_setting( 'home-link-1-url' , array( 'default' => '' ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home-link-1-url', array(
        'label' => __( 'Home Link 1 URL', 'manoa2018' ),
        'section' => 'home-links',
        'settings' => 'home-link-1-url',
    ) ) );
    $wp_customize->add_setting( 'home-link-2' , array( 'default' => '' ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home-link-2', array(
        'label' => __( 'Home Link 2 Text', 'manoa2018' ),
        'section' => 'home-links',
        'settings' => 'home-link-2',
    ) ) );
    $wp_customize->add_setting( 'home-link-2-url' , array( 'default' => '' ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home-link-2-url', array(
        'label' => __( 'Home Link 2 URL', 'manoa2018' ),
        'section' => 'home-links',
        'settings' => 'home-link-2-url',
    ) ) );
    $wp_customize->remove_section( 'colors' );
}
add_action( 'customize_register', 'uhm_catalog_customize_register' );
add_theme_support( 'custom-header' );


// Add categories to pages
function uhm_catalog_page_categories() {
    register_taxonomy_for_object_type('category', 'page');
}
add_action( 'init', 'uhm_catalog_page_categories' );

// remove taxonomy label from get archive title function
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }

    return $title;

});

/**
 * edit breadcrumbs
 */
if ( ! function_exists( 'manoa2018_get_breadcrumbs') ) :
function manoa2018_get_breadcrumbs() {

    // Settings
    $separator          = '<span class="fa fa-angle-right" aria-hidden="true" title="breadcrumb-separator"></span>';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Home';

    // Get the query & post information
    global $post,$wp_query;

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Build the breadcrums
        echo '<nav aria-label="Breadcrumb" id="' . $breadcrums_id . '">';
        echo '<ol class="' . $breadcrums_class . '">';

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if ( is_home() ) {

            echo '<li class="item-current item-posts" aria-current="page"><span class="bread-current bread-posts">' . single_post_title() . '</span></li>';

        } elseif ( is_category() ) {

            echo '<li class="item-posts"><a class="bread-link" href="' . get_permalink( get_page_by_title( 'Courses Overview' ) ) . '">Courses</a></li>';
            echo '<li class="separator"> ' . $separator . ' </li>';
            echo '<li class="item-current item-archive" aria-current="page"><span class="bread-current bread-archive">' . get_the_archive_title() . '</span></li>';

        } elseif ( is_tax() || is_tag() ) {

            echo '<li class="item-posts">Tags</li>';
            echo '<li class="separator"> ' . $separator . ' </li>';
            echo '<li class="item-current item-archive" aria-current="page"><span class="bread-current bread-archive">' . single_term_title() . '</span></li>';

        } elseif ( is_archive() ) {

            echo '<li class="item-current item-archive" aria-current="page"><span class="bread-current bread-archive">' . get_the_archive_title() . '</span></li>';

        } else if ( is_single() ) {

            $posts_page = get_option( 'page_for_posts', true );
            $our_title = get_the_title( $posts_page );
            $posts_url = get_permalink( $posts_page );
            $posts_type = get_post_type_object(get_post_type());

            //echo '<li class="item-posts"><a class="bread-posts" href="' .$posts_url. '">' . $our_title . '</a></li>';
            echo '<li class="item-posts">' . esc_html($posts_type->label) . '</li>';
            echo '<li class="separator"> ' . $separator . ' </li>';
            echo '<li class="item-current item-post" aria-current="page"><span class="bread-current bread-post">' . get_the_title() . '</span></li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){

                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    echo '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    echo '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Current page
                echo '<li class="item-current item-page" aria-current="page"><span class="bread-current bread-page"> ' . get_the_title() . '</span></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-page" aria-current="page"><span class="bread-current bread-page"> ' . get_the_title() . '</span></li>';

            }

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '" aria-current="page"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</span></li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '" aria-current="page"><span class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</span></li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li aria-current="page">' . 'Error 404' . '</li>';
        }

        echo '</ol>';
        echo '</nav>';

    }
}
endif;

add_filter( 'posts_join', 'custom_posts_join', 10, 2 );
/**
 * Callback for WordPress 'posts_join' filter.'
 *
 * @global $wpdb
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 *
 * @param string $join The sql JOIN clause.
 * @param WP_Query $wp_query The current WP_Query instance.
 *
 * @return string $join The sql JOIN clause.
 */
function custom_posts_join( $join, $query ) {

    global $wpdb;

    if ( is_main_query() && is_search() ) {

        $join .= "
        LEFT JOIN
        (
            {$wpdb->term_relationships}
            INNER JOIN
                {$wpdb->term_taxonomy} ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id
            INNER JOIN
                {$wpdb->terms} ON {$wpdb->terms}.term_id = {$wpdb->term_taxonomy}.term_id
        )
        ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id ";

    }

    return $join;

}

add_filter( 'posts_where', 'custom_posts_where', 10, 2 );
/**
 * Callback for WordPress 'posts_where' filter.
 *
 * Modify the where clause to include searches against a WordPress taxonomy.
 *
 * @global $wpdb
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 *
 * @param string $where The where clause.
 * @param WP_Query $query The current WP_Query.
 *
 * @return string The where clause.
 */
function custom_posts_where( $where, $query ) {

    global $wpdb;

    if ( is_main_query() && is_search() ) {

        // get additional where clause for the user
        $user_where = custom_get_user_posts_where();

        $where .= " OR (
                        {$wpdb->term_taxonomy}.taxonomy IN( 'category', 'post_tag' )
                        AND
                        {$wpdb->terms}.name LIKE '%" . esc_sql( get_query_var( 's' ) ) . "%'
                        {$user_where}
                    )";

    }

    return $where;

}

/**
 * Get a where clause dependent on the current user's status.
 *
 * @global $wpdb https://codex.wordpress.org/Class_Reference/wpdb
 *
 * @uses get_current_user_id()
 * @see http://codex.wordpress.org/Function_Reference/get_current_user_id
 *
 * @return string The user where clause.
 */
function custom_get_user_posts_where() {

    global $wpdb;

    $user_id = get_current_user_id();
    $sql     = '';
    $status  = array( "'publish'" );

    if ( $user_id ) {

        $status[] = "'private'";

        $sql .= " AND {$wpdb->posts}.post_author = {$user_id}";

    }

    $sql .= " AND {$wpdb->posts}.post_status IN( " . implode( ',', $status ) . " ) ";

    return $sql;

}


add_filter( 'posts_groupby', 'custom_posts_groupby', 10, 2 );
/**
 * Callback for WordPress 'posts_groupby' filter.
 *
 * Set the GROUP BY clause to post IDs.
 *
 * @global $wpdb https://codex.wordpress.org/Class_Reference/wpdb
 *
 * @param string $groupby The GROUPBY caluse.
 * @param WP_Query $query The current WP_Query object.
 *
 * @return string The GROUPBY clause.
 */
function custom_posts_groupby( $groupby, $query ) {

    global $wpdb;

    if ( is_main_query() && is_search() ) {
        $groupby = "{$wpdb->posts}.ID";
    }

    return $groupby;

}

?>