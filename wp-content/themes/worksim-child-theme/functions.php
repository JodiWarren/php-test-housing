<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


add_action('pre_get_posts', 'set_search_order');
function set_search_order( $query ){
	if (is_admin()) {
		return;
	}

	if (!$query->is_search && !$_GET['housingorder']) {
		return;
	}

	if ($_GET['housingorder'] === 'relevance'){
		$query->set('orderby', 'relevance');
	}

	if ($_GET['housingorder'] === 'date'){
		$query->set('orderby', 'date');
	}
}
