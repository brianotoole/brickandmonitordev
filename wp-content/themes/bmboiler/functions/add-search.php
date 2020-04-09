<?php  function spx_get_search_form() {
	?>
	<form role="search" method="get" class="search-form" action="<?php echo home_url() ?>/search/">
		<input type="search" name="search" placeholder="Search..." required value="<?php echo (!empty($_GET["search"]) ? $_GET["search"] : '') ?>">
		<button><i class="fas fa-search"></i></button>
	</form>
	<?php
}

function spx_get_search_results($search) {

	$taxonomies = get_taxonomies();
	unset($taxonomies["post_format"]);
	unset($taxonomies["nav_menu"]);

	$search_args = array(
		'post_type' => 'any',
		's' => $search,
		'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => -1,
		'tax_query' => array(
			'relation' => 'AND'
		)
	);

	$tax_args = $search_args;
	$tax_args["tax_query"]["relation"] = 'OR';
	unset($tax_args["s"]);

	foreach ($taxonomies as $tax) {
		array_push($search_args["tax_query"], array(
			'taxonomy' => $tax,
			'field' => 'slug',
			'terms' => sanitize_title($search),
			'operator' => 'NOT IN'
		));
		array_push($tax_args["tax_query"], array(
			'taxonomy' => $tax,
			'field' => 'slug',
			'terms' => sanitize_title($search),
		));
	}
	
	$search_query = new WP_Query($search_args);
	$tax_query = new WP_Query($tax_args);

	$searched = $search_query->posts;
	$taxed = $tax_query->posts;
	$results = array_merge($searched, $taxed);

	?>

	<p>Found <?php echo count($results) ?> results.</p>
	<ul class="list">
		<?php foreach ($results as $post): ?>
			<li class="search-result">
				<p class="search-result__tag"><?php echo $post->post_type ?></p>
				<h4 class="search-result__title"><a href="<?php echo get_the_permalink($post->ID) ?>"><?php echo $post->post_title ?></a></h4>
			</li>
		<?php endforeach ?>
	</ul>

	<?php
	
	wp_reset_query();
}