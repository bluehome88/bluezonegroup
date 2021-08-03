<div class="col-lg-6 col-md-6 col-12">
	<div class="item item-media item-media-sm">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="item-thumb" style="background-image:url('<?php the_post_thumbnail_url( 'nozama_lite_item_media' );?>')">
				<a href="<?php the_permalink(); ?>">
					<?php //the_post_thumbnail( 'nozama_lite_item_media' ); ?>
				</a>
			</div>
		<?php endif; ?>

		<div class="item-content">
			<?php if ( 'post' === get_post_type() ) : ?>
				<span class="item-meta post_date">
					<?php echo date("d M", strtotime(get_the_date())); ?>
				</span>
			<?php endif; ?>

			<p class="item-title post_title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</p>
			<p class="item-excerpt">
				<?php echo wp_trim_words( get_the_excerpt(), 30, "..." ); ?>
			</p>
			<a href="<?php the_permalink(); ?>" class="read_more">
				<i class="fas fa-chevron-right"></i> <span>Read More</span>
			</a>
		</div>
	</div>
</div>