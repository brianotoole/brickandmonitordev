<?php
/*

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.

*/

if ( ! defined( 'WPINC' ) ) {
	die;
}

function include_function($filename) {
	return require_once( dirname( __FILE__ ) . '/functions/' . $filename . '.php' );
}

include_function('add-functions');

include_function('add-walkers');

include_function('add-components');

include_function('add-classes');

include_function('add-theme-support');

include_function('add-styles');

include_function('add-custom-jquery');

include_function('add-scripts');

include_function('add-custom-post-types');

include_function('add-taxonomies');

include_function('add-svg-upload-support');

include_function('add-sql-functions');

//include_function('add-actions');

include_function('add-filters');

include_function('add-ajax');

include_function('add-shortcodes');

include_function('remove-head-junk');

//include_function('remove-autoformatting');

//include_function('add-events-actions');

//include_function('add-social-sharing');

include_function('add-search');

// include_function('remove-wpversion-nag');

?>
