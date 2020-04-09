
<?php get_header() ?>

<?php global $post ?>

<section>
	<div class="container">
		<h1><?php the_title() ?></h1>
		<div class="wrapper">
			<?php echo wpautop( $post->post_content, $br = true ) ?>
		</div>
	</div>
</section>

<?php get_footer() ?>
