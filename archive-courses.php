<?php
/**
 * Template for displaying directory page
 */

get_header(); ?>

  <main id="main_area" class="full-width">
    <div id="main_content">

      <?php
      if ( have_posts() ) {
        the_post();
      }
      ?>
        <div id="container">
          <div id="content" role="main">

            <?php manoa2018_get_breadcrumbs(); ?>

            <h1 class="page-title">
              <?php
                printf( __( '%s', 'manoa2018' ), single_cat_title( '', false ) );
              ?>
            </h1>
            <?php if(category_description()) {
              echo category_description();
            } ?>

            <div class="directory-container">
              <?php
                /*
                 * Since we called the_post() above, we need to
                 * rewind the loop back to the beginning that way
                 * we can run the loop properly, in full.
                 */
                rewind_posts();

                /*
                 * Run the loop for the archives page to output the posts.
                 * If you want to overload this in a child theme then include a file
                 * called loop-archive.php and that will be used instead.
                 */
                get_template_part( 'loop', 'courses' );
              ?>
            </div>

          </div><!-- #content -->
        </div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
