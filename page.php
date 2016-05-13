<?php
/**
 * The template for displaying all pages
 *
 * @subpackage Camp
 * @since      Camp 1.0
 */

get_header(); ?>
	<div id="content" class="site-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<div <?php post_class(); ?>>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<a class="camp-top-link" href="javascript: scroll(0,0)">[<?php _e( 'Top', 'camp' ) ?>]</a>
			</div>
		<?php endwhile; ?>
	</div> <!-- #content -->
<?php get_sidebar();
get_footer();
