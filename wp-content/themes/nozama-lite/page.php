<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

if( is_plugin_active( 'elementor/elementor.php') )
{
	\Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-full-width' );

	/**
	 * Before Header-Footer page template content.
	 *
	 * Fires before the content of Elementor Header-Footer page template.
	 *
	 * @since 2.0.0
	 */
	do_action( 'elementor/page_templates/header-footer/before_content' );

	\Elementor\Plugin::$instance->modules_manager->get_modules( 'page-templates' )->print_content();

	/**
	 * After Header-Footer page template content.
	 *
	 * Fires after the content of Elementor Header-Footer page template.
	 *
	 * @since 2.0.0
	 */
	do_action( 'elementor/page_templates/header-footer/after_content' );
}
else
{
	?>

	<main class="main">

		<div class="container">

			<div class="row <?php nozama_lite_the_row_classes(); ?>">

				<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

				<div id="site-content" class="<?php nozama_lite_the_container_classes(); ?>">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

							<?php nozama_lite_the_post_thumbnail(); ?>

							<?php nozama_lite_the_post_header(); ?>

							<div class="entry-content">
								<?php the_content(); ?>

								<?php wp_link_pages( nozama_lite_wp_link_pages_default_args() ); ?>
							</div>

						</article>

						<?php comments_template(); ?>

					<?php endwhile; ?>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

	</main>

	<?php 

}

get_footer();
