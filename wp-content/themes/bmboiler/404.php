<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package WordPress
 */
?>

<?php get_header(); ?>

<?php

$heading = get_field( 'heading', 'options' );
$sub_heading = get_field( 'sub_heading', 'options' );
$found_similar_content = get_field( 'found_similar_content', 'options' );
$no_similar_content = get_field( 'no_similar_content', 'options' );
$suggest_pages = get_field( 'show_suggested_pages', 'options' );

if ($suggest_pages) {
	$slugs = explode('/', substr($_SERVER["REQUEST_URI"], 1));
	global $wpdb;

	$query = "SELECT ID, post_title FROM wp_posts WHERE (post_type != 'revision' and post_type != 'attachment') and (";
	foreach ($slugs as $slug) {
		if (strlen($slug) > 0) {
			$query .= "post_name LIKE '%". $slug ."%' or ";
		}
	}
	$query = substr($query, 0, -4);
	$query .= ') LIMIT 5';
	
	$posts = $wpdb->get_results($query, object);
}

?>

	<section class="Error-404">
		<header class="Error-404__header">
			<h1 class="Error-404__title"><?php echo (!empty($heading) ? $heading : '404') ?></h1>
			<h2 class="Error-404__subtitle"><?php echo (!empty($sub_heading) ? $sub_heading : 'Page Not Found') ?></h1>
		</header><!-- .page-header -->

		<?php if($suggest_pages) : ?>
			
			<?php if(count($posts)) : ?>
				<p class="Error-404__content"><?php echo (!empty($found_similar_content) ? $found_similar_content : '') ?></p>
				<ul>
				<?php foreach ($posts as $post): ?>
					<li>
						<a href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title ?></a>
					</li>
				<?php endforeach ?>
				</ul>
			<?php else : ?>
				<p class="Error-404__content"><?php echo (!empty($no_similar_content) ? $no_similar_content : '') ?></p>
			<?php endif; ?>
		<?php endif; ?>
	</section><!-- .error-404 -->

<?php get_footer(); ?>
