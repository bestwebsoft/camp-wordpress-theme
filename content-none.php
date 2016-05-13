<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @subpackage Camp
 * @since Camp 1.0
 */
?>
<div class="post">
	<header class="camp-post-header">
		<h1 class="camp-post-title"><?php _e( 'Nothing Found', 'camp' ); ?></h1>
		<p><?php _e( 'Try to search again', 'camp' ); ?></p>
		<?php get_search_form(); ?>
	</header>
</div> <!-- .post -->
