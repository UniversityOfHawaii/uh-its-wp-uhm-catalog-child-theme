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

    <div class="header-banner" style="background-image: url(<?php header_image(); ?>)">
      <div class="container">
        <!--<img src="<?php //header_image(); ?>" height="<?php //echo get_custom_header()->height; ?>" width="<?php //echo get_custom_header()->width; ?>" alt="" />-->

        <?php manoa2018_get_breadcrumbs(); ?>

        <h1 class="entry-title"><?php the_title(); ?></h1>
      </div>
    </div>

    <div id="container">
      <div id="content" role="main">

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <div class="entry-content">
            <?php the_content(); ?>
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

          <div class="anchors" aria-hidden="true">
            <!--<h2>Sections</h2>-->
            <?php global $mwm_aal;
            echo $mwm_aal->output_content_links(); ?>
          </div>

        </div><!-- #post-## -->

        <?php //comments_template( '', true ); ?>
      </div>
    </div>

<?php endwhile;
}; // end of the loop. ?>
