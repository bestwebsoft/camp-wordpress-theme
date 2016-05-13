<?php
/**
 * The template for displaying image attachments
 *
 * @subpackage Camp
 * @since Camp 1.0
 */

get_header(); ?>
<div id = "content" class = "site-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<div <?php post_class( 'image-attachment' ); ?>>
			<?php get_template_part( 'content' ); ?>
		</div> <!-- .post -->
	<?php endwhile; ?>
</div> <!-- #content -->
<?php get_sidebar();
get_footer();
