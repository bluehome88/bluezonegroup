<?php
/** @var $term WP_Term */
// Assume we were passed a term object.
if ( empty( $term ) || ! is_object( $term ) ) {
	return;
}

$title     = $term->name;
$subtitle  = get_term_meta( $term->term_id, 'subtitle', true );
$image_id  = get_term_meta( $term->term_id, 'thumbnail_id', true );
$image_url = wp_get_attachment_image_url( $image_id, 'nozama_lite_block_item_md' );
$link_url  = get_term_link( $term->term_id );
?>
<div
	class="block-item block-item-md"
	style="background-image: url(<?php echo esc_url( $image_url ); ?>)"
>
	<div class="block-item-content-wrap">
		<div class="block-item-content">
			<a href="<?php echo esc_url( $link_url ); ?>" class="btn btn-sm btn-block-item">
				<?php echo esc_html( $title ); ?>
			</a>
		</div>
	</div>
</div>
