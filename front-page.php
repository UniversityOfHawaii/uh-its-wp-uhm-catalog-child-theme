<?php
/**
 * Template for displaying the home page
 */

get_header(); ?>

  <main id="main_area">
    <?php if(has_post_thumbnail()): ?>
        <div class="featured-image">
            <?php the_post_thumbnail( 'full' ); ?>
            <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt;
            if ( $caption) { // search for if the image has caption added on it ?>
                <div class="featured-caption">
                    <div class="container">
                        <?php echo $caption; // displays the image caption ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php endif; ?>
    <div id="main_content" class="bootstrap">

      <div id="container">
        <div id="content" role="main">

          <?php if ( have_posts() ) {
            while ( have_posts() ) :
              the_post();
            ?>

            <?php // the_content(); ?>

          <?php endwhile;
          }; // end of the loop. ?>

        </div><!-- #content -->

        <?php if ( is_active_sidebar( 'homepage-widget-area' ) ) : ?>

           <ul class="xoxo homepage-widgets">
           <?php dynamic_sidebar( 'homepage-widget-area' ); ?>
           </ul>

        <?php endif; // end primary widget area ?>

        <div class="academic-groups">
          <h2>Colleges, Schools &amp; Academic Units</h2>
          <?php
          $schools = array(
              'meta_key' => '_wp_page_template',
              'meta_value' => 'page-academic-group.php',
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

      </div><!-- #container -->

<?php get_footer(); ?>
