<?php
/**
 * The template for displaying Archive pages
 *
 * @subpackage Camp
 * @since Camp 1.0
 */

get_header(); ?>
	<?php if ( have_posts() ) :
		$first = true; ?>
		<h1 class = "camp-archive-header">
			<?php printf( __( 'Archives: %s', 'camp'), get_the_date( 'F Y' ) ); ?>
		</h1>
		<div id = "content" class = "site-content">
			<?php while ( have_posts() ) : the_post(); ?>
				<div <?php post_class(); ?>>
					<?php get_template_part( 'content', get_post_format() );
					if ( ! $first ) : ?> <!-- remove top-link for first post -->
						<a class = "camp-top-link" href = "javascript: scroll(0,0)">[<?php _e( 'Top', 'camp' ) ?>]</a>
					<?php endif;
					$first = false; ?>
				</div> <!-- .post -->
			<?php endwhile; ?>
			<nav class = "camp-paging">
				<?php do_action( 'camp_post_nav' ); ?>
			</nav>
		</div> <!-- #content -->
	<?php else : ?>
		<div class = "camp-post">
			<?php get_template_part( 'content', 'none' ); ?>
		</div>
	<?php endif;
	get_sidebar();
get_footer(); ?>