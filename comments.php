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
	<?php if ( ! comments_open() && ! is_page() ) {
		echo '<p>' . __( 'Comments are closed.', 'camp' ) . '</p>';
	}
	if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php $camp_last_nimber = substr( get_comments_number(), - 1 );
			if ( 1 == get_comments_number() ) {
				printf( __( 'One response to &ldquo; %s &rdquo;', 'camp' ), get_the_title() );
			} elseif ( 1 == $camp_last_nimber && get_comments_number() > 20 ) {
				printf( __( '%d Responses to &ldquo; %s &rdquo;  ', 'camp' ), get_comments_number(), get_the_title() );
			} elseif ( $camp_last_nimber > 1 && $camp_last_nimber < 5 && ( get_comments_number() > 20 || get_comments_number() < 10 ) ) {
				printf( __( '%d Responses to &ldquo; %s &rdquo;', 'camp' ), get_comments_number(), get_the_title() );
			} else {
				printf( __( '%d Responses to &ldquo; %s &rdquo; ', 'camp' ), get_comments_number(), get_the_title() );
			} ?>
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
	endif;
	comment_form(); ?>
</div> <!-- .comments -->
