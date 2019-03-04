<?php
/**
 * Template Name: Left Sidebar with Anchor Links
 *
 * A custom page template without sidebar.
 *
 */

get_header(); ?>

  <main id="main_area" class="left-sidebar">
    <div id="main_content">

      <?php
      /*
       * Run the loop to output the page.
       * If you want to overload this in a child theme then include a file
       * called loop-page.php and that will be used instead.
       */
      get_template_part( 'loop', 'anchors' );
      ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
