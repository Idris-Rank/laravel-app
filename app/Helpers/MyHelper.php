<?php

use App\Models\Media;

if (!function_exists('echo_r')) {
	function echo_r($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

if (!function_exists('get_media')) {
	function get_media($media_id) {

		return Media::whereIn('id', [$media_id])->first()->guid ?? false;
	}
}

if (!function_exists('app_url')) {
	function app_url() {

		return $_ENV['APP_URL'];
	}
}


if (!function_exists('post_status')) {
	function post_status($key) {

		$status = [1 => 'Publish', 'Draft', 'Pending', 'Private', 'Future', 'Trash'];

		return isset($status[$key]) ? $status[$key] : $status[2];
	}
}