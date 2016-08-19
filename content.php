<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @subpackage Camp
 * @since      Camp 1.0
 */

$check = '';
if ( get_post_meta( get_the_ID(), 'camp_in_slider', 'yes' ) ) {
	$check = 'checked';
} ?>
<?php if ( is_sticky() && is_home() && ! is_page() ) : ?>
	<h1 class="camp-featured-post">
		<?php _e( 'Featured post', 'camp' ); ?>
	</h1>
<?php endif; ?>
<header class="camp-post-header">
	<h1 class="camp-post-title">
		<?php if ( ! is_singular() ) { ?>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<?php } else {
			the_title();
		} ?>
	</h1>
	<p class="camp-post-meta">
		<?php _e( 'Posted on ', 'camp' );
		if ( is_singular() ) { ?>
			<a href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a>
		<?php } else { ?>
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a>
		<?php }
		if ( is_attachment() && wp_attachment_is_image() ) {
			echo __( 'in', 'camp' ) . ' <a href = "' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a>';
		} elseif ( has_category() ) {
			_e( 'in', 'camp' );
			the_category( ', ' );
		} ?>
	</p>
	<?php the_post_thumbnail(); ?>
</header>
<?php if ( is_attachment() && wp_attachment_is_image() ) : ?>
	<nav>
		<span class="prev-img-link">
			<?php previous_image_link( false, __( '&larr; Previous', 'camp' ) ); ?>
		</span>
		<span class="next-img-link">
			<?php next_image_link( false, __( 'Next &rarr;', 'camp' ) ); ?>
		</span>
	</nav>
	<div class="attachment">
		<?php echo wp_get_attachment_image( $post->ID, array( 500, 500 ) );
		the_excerpt(); ?>
	</div>
<?php endif;
if ( is_search() ) {
	the_excerpt();
} else {
	the_content();
}
wp_link_pages(); ?>
<footer class="camp-post-footer">
	<?php if ( has_tag() ) : ?>
		<p class="camp-tags"><?php the_tags( __( 'Tags: ', 'camp' ) ); ?></p>
	<?php endif;
	if ( is_single() && current_user_can( 'publish_pages' ) && has_post_thumbnail() ) : ?>
		<form id="meta-for-slider" method="post" action= <?php echo get_permalink(); ?>>
			<label><?php _e( 'Add to slider?', 'camp' ); ?></label>
			<input name="camp_add_to_slider" id="check-for-slider" type="checkbox" <?php echo $check; ?>>
			<input name="save" type="submit" value="save">
		</form>
	<?php endif;
	comments_template(); ?>
</footer>
