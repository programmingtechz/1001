<?php
/**
 * Theme Single Post Section for our theme.
 *
 * @package ThemeGrill
 * @subpackage Masonic
 * @since 1.0
 */

get_header(); ?>

<div class="site-content clear">
   <div id="container" class="wrapper clear">
      <div class="primary">

         <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', 'single'); ?>

            <?php masonic_post_nav(); ?>


         <?php endwhile; // end of the loop. ?>
      </div>
      <?php get_sidebar(); ?>
   </div><!-- #container -->
</div><!-- .site-content clear -->

<?php get_footer(); ?>