<?php
/**
 * Template for displaying the home page
 */

get_header(); ?>

  <main id="main_area">
    <?php if(has_post_thumbnail()): ?>
        <div class="featured-image">
          <?php if (get_theme_mod('home_banner') !='') : ?>
            <img src="<?php echo get_theme_mod('home_banner'); ?>" alt="UH students">
          <?php endif; ?>
          <div class="featured-links">
            <div class="container">
              <div class="left-link">
                <a href="<?php echo get_theme_mod('home-link-1-url'); ?>" title="go to <?php echo get_theme_mod('home-link-1'); ?>">
                  <?php echo get_theme_mod('home-link-1'); ?>
                  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
              </div>
              <div class="right-link">
                <a href="<?php echo get_theme_mod('home-link-2-url'); ?>" title="go to <?php echo get_theme_mod('home-link-2'); ?>">
                  <?php echo get_theme_mod('home-link-2'); ?>
                  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
    <?php endif; ?>
    <div id="main_content" class="bootstrap">
      <div id="container">
        <div id="content" role="main">

          <?php if ( have_posts() ) {
            while ( have_posts() ) :
              the_post();
            ?>

            <?php //the_content(); ?>

          <?php endwhile;
          }; // end of the loop. ?>

          <?php if ( is_active_sidebar( 'homepage-widget-area' ) ) : ?>

             <ul class="xoxo homepage-widgets">
             <?php dynamic_sidebar( 'homepage-widget-area' ); ?>
             </ul>

          <?php endif; // end primary widget area ?>

        </div><!-- #content -->
      </div>
    </div>

    <div id="schools-list" class="full-width-section">
      <div class="container">

        <div class="academic-groups">
          <h2>Colleges, Schools &amp; Academic Units</h2>
          <?php
          $schools = array(
              'meta_key' => '_wp_page_template',
              'meta_value' => 'page-academic-group-main.php',
              'orderby' => 'meta_value',
              'order' => 'ASC',
              'echo' => '1',
              'depth' => '1',
              'sort_column' => 'menu_order',
              'title_li' => '',
              'menu_class' => 'schools-list'
          ); ?>
          <?php wp_page_menu( $schools ); ?>
        </div>
      </div>

    </div><!-- section -->

<?php get_footer(); ?>
