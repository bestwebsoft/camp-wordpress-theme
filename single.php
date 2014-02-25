<?php
/**
 * The template for displaying all single posts
 *
 * @subpackage Camp
 * @since Camp 1.0
 */

get_header(); ?>
	<div id = "content" class = "site-content">
		<?php if ( have_posts() ) : the_post(); ?>
			<div <?php post_class(); ?>>
				<?php get_template_part( 'content', get_post_format() ); ?>
			</div>
		<?php endif; ?>
		<nav class = "camp-paging">
			<?php do_action( 'camp_post_nav' ); ?>
		</nav>
	</div> <!-- #content -->
	<?php get_sidebar();
get_footer(); ?>