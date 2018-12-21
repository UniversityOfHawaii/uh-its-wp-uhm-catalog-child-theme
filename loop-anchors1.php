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

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php if ( is_front_page() ) { ?>
            <h2 class="entry-title"><?php the_title(); ?></h2>
          <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          <?php } ?>

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
            <h2>Sections</h2>
            <?php global $mwm_aal;
            echo $mwm_aal->output_content_links(); ?>
          </div>
<script type="text/javascript">
  var TRange=null;

function findString (str) {
 if (parseInt(navigator.appVersion)<4) return;
 var strFound;
 if (window.find) {

  // CODE FOR BROWSERS THAT SUPPORT window.find

  strFound=self.find(str);
  if (!strFound) {
   strFound=self.find(str,0,1);
   while (self.find(str,0,1)) continue;
  }
 }
 else if (navigator.appName.indexOf("Microsoft")!=-1) {

  // EXPLORER-SPECIFIC CODE

  if (TRange!=null) {
   TRange.collapse(false);
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
  if (TRange==null || strFound==0) {
   TRange=self.document.body.createTextRange();
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
 }
 else if (navigator.appName=="Opera") {
  alert ("Opera browsers not supported, sorry...")
  return;
 }
 if (!strFound) alert ("String '"+str+"' not found!")
 return;
}
</script>
<form id="f1" name="f1" action="javascript:void()" onsubmit="if(this.t1.value!=null &amp;&amp; this.t1.value!='')
parent.findString(this.t1.value);return false;">
<input type="text" id="t1" name="t1" value="text" size="20">
<input type="submit" name="b1" value="Find">
</form>
        </div><!-- #post-## -->

        <?php //comments_template( '', true ); ?>
      </div>
    </div>

<?php endwhile;
}; // end of the loop. ?>
