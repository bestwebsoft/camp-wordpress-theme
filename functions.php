<?php

if ( ! isset( $content_width ) ) {
	$content_width = 500;
}

function camp_setup() {
	/* Makes Camp available for translation. */
	load_theme_textdomain( 'camp', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menu( 'head', 'Navigation menu' );

	/* This theme supports custom background color and image. */
	add_theme_support( 'custom-background', array( 'default-image' => get_template_directory_uri() . '/images/main-bg.jpg' ) );

	/* This theme supports custom header image. */
	add_theme_support( 'custom-header', array(
		'default-image' => get_template_directory_uri() . '/images/default-image.jpg',
		'height'        => 343,
		'width'         => 1200,
	) );
	add_editor_style();
}

function camp_register_sidebar() {
	/* Right sidebar */
	register_sidebar( array(
		'name' => 'Sidebar',
		'id'   => 'sidebar-1',
	) );
}

function camp_add_scripts() {
	/* Load script */
	wp_enqueue_script( 'camp-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );

	/* Load main stylesheet */
	wp_enqueue_style( 'camp-style', get_stylesheet_uri() ); ?>
	<script type="text/javascript"> var camp_path = "<?php echo get_template_directory_uri(); ?>"; </script><?php

	/* Load stylesheet for IE */
	wp_enqueue_style( 'camp-ie', get_template_directory_uri() . '/css/ie.css', array( 'camp-style' ) );
	wp_style_add_data( 'camp-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/* Metabox for slider */
function camp_add_metabox_for_slider() {
	add_meta_box(
		'metabox_id',
		__( 'For Slider', 'camp' ),
		'camp_metabox_callback',
		'post',
		'side'
	);
}

function camp_metabox_callback() {
	$check = '';
	if ( get_post_meta( get_the_ID(), 'camp_in_slider', 'yes' ) ) {
		$check = 'checked';
	}
	_e( 'If you want to add this post to slider, choose the checkbox &nbsp;', 'camp' ); ?>
	<form action="" method="post">
		<input type="checkbox" name="camp_add_to_slider" <?php echo $check; ?>>
	</form>
<?php }

/* Adding post to slider via Admin Panel */
function camp_add_post_to_slider_ap() {
	if ( isset( $_POST['camp_add_to_slider'] ) ) {
		add_post_meta( get_the_ID(), 'camp_in_slider', 'yes', true );
	} /* add post to slider */
	else {
		delete_post_meta( get_the_ID(), 'camp_in_slider' );
	} /* remove post from slider */
}

/* Adding post to slider via Frontend */
function camp_add_post_to_slider_fe() {
	if ( isset( $_POST['save'] ) ) {
		if ( isset( $_POST['camp_add_to_slider'] ) ) {
			add_post_meta( get_the_ID(), 'camp_in_slider', 'yes', true );
		} /* add post to slider */
		else {
			delete_post_meta( get_the_ID(), 'camp_in_slider' );
		} /* remove post from slider */
		echo '<meta http-equiv="refresh" content="0">'; /* refresh page */
	}
}

/* Cut excerpt for slider */
function camp_excerpt_for_slider() {
	$excerpt = get_the_excerpt();
	$words   = explode( ' ', $excerpt );
	if ( count( $words ) > 20 ) {
		array_splice( $words, 20 );
		$excerpt = implode( ' ', $words );
		echo $excerpt . '...';
	} else {
		echo $excerpt;
	}
}

/* Comments */
function camp_comment_callback() { ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-body" id="div-comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
				<cite class="fn"><?php comment_author_link(); ?></cite>
				<span class="says"><?php _e( 'says:', 'camp' ); ?></span>
			</div>
			<!-- .comment-author -->
			<div class="comment-meta">
				<a href="<?php comment_link(); ?>">
					<?php echo get_comment_date() . __( ' at ', 'camp' ) . get_comment_time(); ?>
				</a>
			</div>
			<!-- .comment-meta -->
			<?php comment_text(); ?>
			<div class="reply">
				<?php comment_reply_link( array(
					'add_below'  => 'div-comment',
					'depth'      => 1,
					'max_depth'  => 10,
					'reply_text' => __( 'Reply', 'camp' ),
				) );
				edit_comment_link( __( 'Edit', 'camp' ), ' | ', '' ); ?>
			</div>
		</div>
	</li>
<?php }

/* Post navigation */
function camp_post_navigation() {
	if ( get_previous_posts_link() ) {
		echo '<div class = "camp-prev-post-link" >';
		previous_posts_link( __( 'Newer posts &rarr;', 'camp' ) );
		echo '</div>';
	}
	if ( get_next_posts_link() ) {
		echo '<div class = "camp-next-post-link" >';
		next_posts_link( __( '&larr; Older posts', 'camp' ) );
		echo '</div>';
	}
	if ( is_single() ) {
		if ( get_previous_post_link() ) {
			echo '<div class = "camp-prev-post-link" >';
			previous_post_link( '%link', __( 'Next post &rarr;', 'camp' ) );
			echo '</div>';
		}
		if ( get_next_post_link() ) {
			echo '<div class = "camp-next-post-link" >';
			next_post_link( '%link', __( '&larr; Previous post', 'camp' ) );
			echo '</div>';
		}
	}
}

/* backwards compatibility title-tag */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	/*customize title if WP version < 4.1*/
	function camp_wp_title( $title ) {
		global $page, $paged;
		$title .= get_bloginfo( 'name' );
		if ( is_single() || is_page() ) {
			$title .= ' | ' . get_the_title();
		}
		if ( $page > 1 || $paged > 1 ) {
			$title .= sprintf( __( ' | Page %s', 'camp' ), max( $page, $paged ) );
		}

		return $title;
	}

	/*add wp_title filter if WP version < 4.1*/
	add_filter( 'wp_title', 'camp_wp_title' );

	/* render title in wp_head if WP version < 4.1 */
	function camp_render_title() { ?>
		<title><?php wp_title( ' | ', true, 'right' ); ?></title>
	<?php }

	add_action( 'wp_head', 'camp_render_title' );
}
/* end backwards compatibility */

/* Hooks */
add_action( 'wp_enqueue_scripts', 'camp_add_scripts' );
add_action( 'after_setup_theme', 'camp_setup' );
add_action( 'widgets_init', 'camp_register_sidebar' );
add_action( 'add_meta_boxes', 'camp_add_metabox_for_slider' );
add_action( 'save_post', 'camp_add_post_to_slider_ap' );
add_action( 'wp_head', 'camp_add_post_to_slider_fe' );
add_action( 'camp_excerpt', 'camp_excerpt_for_slider' );
add_action( 'camp_post_nav', 'camp_post_navigation' );
