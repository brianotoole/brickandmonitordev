<?php
/*
Template Name: Posts Browser
*/

// Header
get_header();

// Hero
get_template_part('template-parts/hero', '');

?>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- <script src="<?php echo get_template_directory_uri() ?>/dist/js/vue.min.js"></script> -->

<?php

$post_type = get_field( 'post_type' );
$taxonomies = get_post_type_taxonomies( $post_type );
$filters = get_field( 'filters' );

$query = array(
	'post_type' => $post_type,
	'posts_per_page' => (int)get_field( 'posts_per_page' ),
	'paged' => 1,
	'post_status' => 'publish',
	'orderby' => 'date',
	'order' => 'DESC',
);
$elements = array(
	'filter_form' => '.filters form',
	'list' => '.list',
	'pagination' => '.pagination',
	'load_more' => '.load-more',
	'all_loaded' => '.all-loaded',
	'none_found' => '.none-found',
	'loading' => '.loading',
	'reset' => '.reset',
	'error' => '.error'
);
$content = array(
	'filter_button_text' => get_field( 'filter_button_text' ),
	'load_more_text' => get_field( 'load_more_text' ),
	'all_loaded_text' => get_field( 'all_loaded_text' ),
	'none_found_text' => get_field( 'none_found_text' ),
	'error_text' => get_field( 'error_text' )
);
$appearance = array(
	'list_item_layout' => get_field( 'list_item_layout' ),
	'list_item_style' => get_field( 'list_item_style' )
);

?>

<section class="blog section--sm">

	<div id="blog"></div>

</section>

<script>
	// Set window data that blog-vue can retrieve
	window.blog = {
		admin_ajax: '<?php echo admin_url('admin-ajax.php') ?>?action=blog_load_more_json',
		query: <?php echo json_encode($query) ?>,
		filters: <?php echo json_encode($filters) ?>,
		content: <?php echo json_encode($content) ?>,
		appearance: <?php echo json_encode($appearance) ?>
	}
</script>

<script src="<?php echo get_template_directory_uri() ?>/dist/js/blog_vue.js"></script>

<?php get_footer() ?>
