<?php
/*
Template Name: Search Results
*/
?>

<?php get_header() ?>

<?php

$search = $_GET["search"];
$empty_search_text = get_field( 'empty_search_text' );
$vague_search_text = get_field( 'vague_search_text' );

?>

<section class="search-results">
	<div class="container">
		<?php spx_get_search_form() ?>
		<?php if (empty($search)) : ?>
			<h2 class="heading"><?php echo $empty_search_text ?></h2>
		<?php elseif ($search == 'the' || $search == 'a' || $search == 'of' || $search == 'at') : ?>
			<h2 class="heading"><?php echo $vague_search_text ?></h2>
		<?php else: ?>
			<h2 class="heading">Search results for "<?php echo $search ?>"</h2>
			<?php spx_get_search_results($search) ?>
		<?php endif ?>
	</div>
</section>

<?php get_footer() ?>
