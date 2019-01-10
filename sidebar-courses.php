<?php
/**
 * Sidebar template containing the primary and secondary widget areas
 *
 */
?>

  <div id="category-description" class="narrow-sidebar" role="complementary">

    <?php if(category_description()) { ?>
        <?php echo category_description(); ?>
    <?php } ?>

  </div><!-- #primary .widget-area -->
