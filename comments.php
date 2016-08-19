<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @subpackage Camp
 * @since      Camp 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>
<div id="comments">
	<?php if ( have_comments() && comments_open() ) : ?>
		<h3 class="comments-title">
			<?php printf( _n( 'One response to &ldquo; %2$s &rdquo;', '%1$s responses to &ldquo; %2$s &rdquo;', get_comments_number(), 'camp' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
		</h3>

		<!-- comment navigation -->
		<?php if ( get_comment_pages_count() > 1 ) : ?>
			<div class="navigation">
				<div class="alignleft">
					<?php previous_comments_link( __( '&larr; Older comments', 'camp' ) ); ?>
				</div>
				<div class="alignright">
					<?php next_comments_link( __( 'Newer comments &rarr;', 'camp' ) ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php $args = array(
			'style'      => 'ul',
			'reply_text' => __( 'Reply', 'camp' ),
			'callback'   => 'camp_comment_callback',
		); ?>

		<ol class="commentlist">
			<?php wp_list_comments( $args ); ?>
		</ol>

		<!-- comment navigation -->
		<?php if ( get_comment_pages_count() > 1 ) : ?>
			<div class="navigation">
				<div class="alignleft">
					<?php previous_comments_link( __( '&larr; Older comments', 'camp' ) ); ?>
				</div>
				<div class="alignright">
					<?php next_comments_link( __( 'Newer comments &rarr;', 'camp' ) ); ?>
				</div>
			</div>
		<?php endif;
	else :
		echo '<p>' . __( 'Comments are closed.', 'camp' ) . '</p>';
	endif;
	comment_form(); ?>
</div> <!-- .comments -->
