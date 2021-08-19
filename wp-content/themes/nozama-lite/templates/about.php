<?php
/**
 * Template Name: About page
 */

get_header(); ?>

<main class="landing">

    <?php the_content(); ?>
    <div class="gallery">
        <div class="container">
        <?php the_widget('WP_Widget_Media_Gallery', 'title=Gallery' ); ?>
        </div>
    </div>
    <div class="nozama_featured_product">
        <div class="container">
        <?php the_widget( 'CI_Widget_Home_Latest_Products', 'title=Related Products' ); ?>
        </div>
    </div>
    <div class="nozama_news">
        <div class="container">
        <?php the_widget( 'CI_Widget_Latest_Posts', 'title=Related articles' ); ?>
        </div>
    </div>
</main>

<?php get_footer();
