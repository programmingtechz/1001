<?php
/**
 * Theme Page Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */

get_header(); ?>

<div class="site-content">
   <div id="container" class="wrapper clear">
      <div class="primary">

         <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'page'); ?>

         <?php endwhile; // end of the loop. ?>
      </div>
      <?php get_sidebar(); ?>
   </div><!-- #container -->
</div><!-- .site-content -->

<?php get_footer(); ?>