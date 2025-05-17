<?php

if (!function_exists('echo_r')) {
	function echo_r($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}
