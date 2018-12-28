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
            <?php the_content(); ?>

            <?php
              if($post->post_parent)
              $children = wp_list_pages('title_li=&child_of='.$post->post_parent.'&echo=0'); else
              $children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
              if ($children) { ?>

              <ul class="child-pages">
                  <?php echo $children; ?>
              </ul>

            <?php } ?>

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
