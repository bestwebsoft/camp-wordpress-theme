<?php
/**
 * The template for displaying the footer
 *
 * @subpackage Camp
 * @since Camp 1.0
 */
?>
			</div> <!-- .camp-main -->
			<footer>
				<?php wp_footer(); ?>
				<div class = "camp-footer">
					<div class = "camp-cpy">
						<?php echo '&copy; ' . date( 'Y ' ) . get_bloginfo( 'name' ); ?>
					</div>
					<div class = "camp-author">
						<?php printf( __( 'Powered by %s and %s', 'camp' ), '<a href = "' . esc_url( wp_get_theme()->get( 'AuthorURI' ) ) . '">BestWebLayout</a>', '<a href = "' . esc_url( 'http://wordpress.org/' ) . '">WordPress</a>' ); ?>
					</div>
				</div> <!-- .camp-footer -->
			</footer>
		</div> <!-- .camp-page -->
	</body>
</html>
