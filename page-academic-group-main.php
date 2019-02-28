<?php
/**
Template Name: Academic Group Main
 *
 * A custom page template for pages with the sidebar on the left.
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
      get_template_part( 'loop', 'academic-group-main' );
      ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
