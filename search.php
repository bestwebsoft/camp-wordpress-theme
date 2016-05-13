<?php
/**
 * The template for displaying Search Results pages
 *
 * @subpackage Camp
 * @since      Camp 1.0
 */

get_header(); ?>
	<h1 class="camp-archive-header">
		<?php printf( __( 'Search results for: %s', 'camp' ), get_search_query() ); ?>
	</h1>
	<div id="content" class="site-content">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?>>
					<?php get_template_part( 'content', get_post_format() ); ?>
				</div>
			<?php endwhile; ?>
			<nav class="camp-paging">
				<?php do_action( 'camp_post_nav' ); ?>
			</nav>
		<?php else :
			get_template_part( 'content', 'none' );
		endif; ?>
	</div> <!-- #content -->
<?php get_sidebar();
get_footer();
