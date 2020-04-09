<?php

	add_action('wp_ajax_nopriv_blog_load_more', 'blog_load_more');
	add_action('wp_ajax_blog_load_more', 'blog_load_more');

	function blog_load_more() {

		$query = $_POST;
		$list_item_style = $query["list_item_style"];
		unset($query["list_item_style"]);
		unset($query["action"]);

		get_paginated_posts($query, $list_item_style);

		exit;

	}

	if(isset($_REQUEST['action']) && $_REQUEST['action']=='blog_load_more_json'):
		add_action('wp_ajax_blog_load_more_json', 'blog_load_more_json');
		add_action('wp_ajax_nopriv_blog_load_more_json', 'blog_load_more_json');
	endif;

	function blog_load_more_json() {

		// error_reporting(E_ALL); 
		// ini_set("display_errors", 1);

		$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
		// Retrieve JSON payload
		$payload = json_decode(file_get_contents('php://input'));

		// Convert to associative array
		$payload = json_decode(json_encode($payload), true);

		wp_send_json(get_paginated_posts_json($payload));
		// wp_send_json($payload);

		exit;

	}

	if(isset($_REQUEST['action']) && $_REQUEST['action']=='tributes_load_more_json'):
		add_action('wp_ajax_tributes_load_more_json', 'tributes_load_more_json');
		add_action('wp_ajax_nopriv_tributes_load_more_json', 'tributes_load_more_json');
	endif;

	function tributes_load_more_json() {

		// error_reporting(E_ALL); 
		// ini_set("display_errors", 1);

		$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
		// Retrieve JSON payload
		$payload = json_decode(file_get_contents('php://input'));

		// Convert to associative array
		$payload = json_decode(json_encode($payload), true);

		wp_send_json(get_paginated_tributes_json($payload));
		// wp_send_json($payload);

		exit;

	}

	add_action('wp_ajax_nopriv_spx_update_option', 'spx_update_option');
	add_action('wp_ajax_spx_update_option', 'spx_update_option');

	function spx_update_option() {

		$key = $_POST["key"];
		$value = $_POST["value"];

		echo (update_option($key, $value) ? 'true' : 'false');

		exit;

	}

?>
