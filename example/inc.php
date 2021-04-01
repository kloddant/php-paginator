<?php

	if (!function_exists('dict_get')) {
		function dict_get($dict, $key, $default=null) {
			return (array_key_exists($key, $dict) ? $dict[$key] : $default);
		}
	}

	$category = get_queried_object();

	$current_page_number = dict_get($_GET, 'page', 1);
	$per_page = dict_get($_GET, 'per_page', 8);
	$offset = ($current_page_number-1)*$per_page;

	require_once('paginator.php');
	$post_paginator = new Paginator(array(
		"number_of_objects" => $category->count, 
		"current_page_number" => $current_page_number,
		"per_page" => $per_page,
	));

?>
