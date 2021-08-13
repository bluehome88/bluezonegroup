<?php
/**
 * Template Name: About page
 */

get_header(); ?>

<main class="landing">

    <?php the_content(); ?>
    <div class="container">
        <?php the_widget('WP_Widget_Media_Gallery', 'title=Gallery' ); ?>
        <?php the_widget( 'CI_Widget_Home_Latest_Products', 'title=Related Products' ); ?>
        <?php the_widget( 'CI_Widget_Latest_Posts', 'title=Related articles' ); ?>
    </div>
</main>

<?php get_footer();
