<form class="camp-search-form" action="<?php echo home_url(); ?>" method="get">
	<input class="camp-search-txt" type="text" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Enter search keyword', 'camp' ); ?>" />
	<button class="camp-search-btn" type="submit">
		<img src="<?php echo get_template_directory_uri(); ?>/images/search-button.jpg" /></button>
</form>
