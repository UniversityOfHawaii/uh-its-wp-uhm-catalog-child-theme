<?php
/**
 * Template for displaying all single posts
 *
 */

get_header(); ?>
  <main id="main_area">
    <div id="main_content">
      <div id="container">
        <div id="content" role="main">

          <?php manoa2018_get_breadcrumbs(); ?>

          <?php
          /*
           * Run the loop to output the post.
           * If you want to overload this in a child theme then include a file
           * called loop-single.php and that will be used instead.
           */
          get_template_part( 'loop', 'course' );
          ?>

        </div><!-- #content -->
      </div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
