<?php
/**
 * The loop that displays a page
 *
 * The loop displays the posts and the post content. See
 * https://codex.wordpress.org/The_Loop to understand it and
 * https://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 */
?>

<?php
if ( have_posts() ) {
  while ( have_posts() ) :
    the_post();
  ?>

    <div id="container">
      <div id="content" role="main">
        <?php manoa2018_get_breadcrumbs(); ?>

        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <div class="entry-content">
            <div class="course-content-container">
              <div class="course-content">
                <?php the_content(); ?>
              </div>
              <div class="course-sidebar">
                <?php
                  $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0&depth=3');
                  if ($children) { ?>

                  <h1>Child Pages</h1>
                  <ul class="child-pages">
                      <?php echo $children; ?>
                  </ul>

                <?php } ?>
              </div>
            </div>

            <h1>Course Listing by Department</h1>
            <?php $categories = get_categories(array(
              'child_of'            => 0,
              'current_category'    => 0,
              'depth'               => -1,
              'echo'                => 1,
              'exclude'             => '',
              'exclude_tree'        => '',
              'feed'                => '',
              'feed_image'          => '',
              'feed_type'           => '',
              'hide_empty'          => 1,
              'hide_title_if_empty' => false,
              'hierarchical'        => true,
              'order'               => 'ASC',
              'orderby'             => 'name',
              'separator'           => '<br />',
              'show_count'          => 0,
              'show_option_all'     => '',
              'show_option_none'    => __( 'No categories' ),
              'style'               => 'list',
              'taxonomy'            => 'category',
              'title_li'            => __( 'Categories' ),
              'use_desc_for_title'  => 1,
            ));
            ?>
            <ul class="course-directory">
              <?php foreach($categories as $category) {
                 echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
              } ?>
            </ul>

            <?php
            wp_link_pages(
              array(
                'before' => '<div class="page-link">' . __( 'Pages:', 'manoa2018' ),
                'after'  => '</div>',
              )
            );
            ?>

            <?php edit_post_link( __( 'Edit', 'manoa2018' ), '<span class="edit-link">', '</span>' ); ?>
          </div><!-- .entry-content -->

        </div><!-- #post-## -->

        <?php //comments_template( '', true ); ?>
      </div>
    </div>

<?php endwhile;
}; // end of the loop. ?>
