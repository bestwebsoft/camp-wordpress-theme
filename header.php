<?php
/**
 * The Header template for our theme
 *
 * @subpackage Camp
 * @since      Camp 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="camp-page">
	<header>
		<div class="camp-head">
			<div class="camp-head-title">
				<h1>
					<a href="<?php echo home_url(); ?>" style="color: #<?php header_textcolor(); ?>;"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<p><?php bloginfo( 'description' ); ?></p>
			</div> <!-- .head-title -->
			<nav class="camp-site-navigation">
				<ul>
					<?php //wp_list_pages( 'title_li' );
					wp_nav_menu( array( 'theme_location' => 'head' ) ); ?>
				</ul>
			</nav>
		</div> <!-- .head -->
		<div class="camp-slider">
			<?php $query = new WP_Query( array( 'meta_key' => 'camp_in_slider', 'meta_value' => 'yes' ) );
			if ( $query->have_posts() ) {
				$camp_slide_id = 0;
				while ( $query->have_posts() ) {
					$query->the_post();
					if ( get_the_post_thumbnail() ) { ?>
						<div class="camp-slide" id="slide-<?php echo $camp_slide_id; ?>">
							<?php the_post_thumbnail(); ?>
							<div class="camp-slide-line">
								<div class="camp-slide-text">
									<h1><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
									<h2><?php do_action( 'camp_excerpt' ); ?></h2>
								</div>
							</div>
						</div>
						<?php $camp_slide_id ++;
					}
				} ?>
				<img class="camp-slider-btn" id="left" src="<?php echo get_template_directory_uri(); ?>/images/slider-left.jpg" alt="<" />
				<img class="camp-slider-btn" id="right" src="<?php echo get_template_directory_uri(); ?>/images/slider-right.jpg" alt=">" />
			<?php } else {
				printf( '<img src = "%s" />', get_header_image() );
			}
			wp_reset_postdata(); ?>
		</div> <!-- .slider -->
	</header>
	<div class="camp-main">
