<?php

if ( ! function_exists( 'magic_page_templates') ) {
	function magic_page_templates( array $templates = [], string $root = '' ) {
		if ( !$root ) {
			$root = plugin_dir_path( __FILE__ );
		}

		// Add a filter to the wp 4.7 version attributes metabox
		add_filter( 'theme_page_templates',  function ( $posts_templates ) use ( $templates ) {
			$posts_templates = array_merge( $posts_templates, $templates );
			return $posts_templates;
		} );

		// Add a filter to the save post to inject our template into the page cache
		add_filter( 'wp_insert_post_data', function( $atts ) use ( $templates ) {
			// Create the key used for the themes cache
			$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

			// Retrieve the cache list.
			// If it doesn't exist, or it's empty prepare an array
			$new_templates = wp_get_theme()->get_page_templates();
			if ( empty( $new_templates ) ) {
				$new_templates = array();
			}

			// New cache, therefore remove the old one
			wp_cache_delete( $cache_key , 'themes');

			// Now add our template to the list of templates by merging our templates
			// with the existing templates array from the cache.
			$templates = array_merge( $templates, $new_templates );

			// Add the modified cache to allow WordPress to pick it up for listing
			// available templates
			wp_cache_add( $cache_key, $templates, 'themes', 1800 );

			return $atts;
		} );


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter( 'template_include', function( $template ) use ( $templates, $root ) {
			// Get global post
			global $post;

			// Return template if post is empty
			if ( ! $post ) {
				return $template;
			}

			// Return default template if we don't have a custom one defined
			if ( ! isset( $templates[get_post_meta(
				$post->ID, '_wp_page_template', true
			)] ) ) {
				return $template;
			}

			$file = $root . get_post_meta(
				$post->ID, '_wp_page_template', true
			);

			// Just to be safe, we check if the file exist first
			if ( file_exists( $file ) ) {
				return $file;
			} else {
				echo 'Magic Page Templates in ' . $root . ' is missing a page template file : ' . $file;
			}

			// Return template
			return $template;
		} );
	};
}
