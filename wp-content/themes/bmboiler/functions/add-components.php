<?php

function render_page_builder ( $modules ) {

	foreach ($modules as $mod) {
		
		call_user_func( 'render_' . $mod["acf_fc_layout"], $mod );

	}

}

// Hero
function render_hero ( $fields ) {
	if (empty($fields["hero_background_image"])) {
		$fields["hero_background_image"] = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	}
	if (empty($fields["hero_title"])) {
		$fields["hero_title"] = get_the_title();
	}
	if (empty($fields["hero_options"])) {
		$fields["hero_options"] = array('');
	}
	?>

		<section class="hero">
			<div class="hero__wrapper" style="background: url('<?php echo $fields["hero_background_image"] ?>') center/cover no-repeat;">
				<div class="hero__content container <?php echo $fields["hero_image_aspect_ratio"] ?> hero--<?php echo $fields["hero_background_position"] ?> <?php foreach($fields["hero_options"] as $opt): echo $opt.' '; endforeach; ?>">
					<div class="wrapper container">
					<?php if(!empty($fields["hero_title"])) : ?>
						<h1 class="hero__title"><?php echo $fields["hero_title"]; ?></h1>
					<?php endif; ?>
					<?php if(!empty($fields["hero_subtitle"])) : ?>
						<p class="hero__subtitle"><?php echo $fields["hero_subtitle"]; ?></p>
					<?php endif; ?>
					<?php if ($fields["hero_button"]) : ?>
						<div class="hero__btn-container">
							<?php render_link($fields["hero_button"]) ?>
						</div>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

	<?php
}

// Custom Components

function render_basic_content ( $fields ) {
	$is_module = in_array('basic_content', $fields);
	?>
		<?php if(empty($fields["heading"]) && empty($fields["content"]) && empty($fields["button"])) : ?>
			<?php return; ?>
		<?php else : ?>
				<?php if($is_module) : ?>
					<section class="basic-content">
						<div class="container">
				<?php endif; ?>

					<header>
						<?php if(!empty($fields["heading"])) : ?>
							<h2 class="sec-heading"><?php echo $fields["heading"] ?></h2>
						<?php endif; ?>
						<?php if(!empty($fields["content"])) : ?>
							<div class="content bigger narrow format-content">
								<?php echo $fields["content"] ?>
							</div>
						<?php endif; ?>
						<?php if(!empty($fields["button"])) : ?>
							<?php render_link( $fields["button"] ) ?>
						<?php endif; ?>
					</header>

				<?php if($is_module) : ?>
						</div>
					</section>
				<?php endif; ?>
		<?php endif; ?>

	<?php
}

function render_block_quote ( $fields ) {
	?>

	<section>
		<div class="container">
			<di class="block-quote">
			  <h1 class="block-quote__quote"><?php echo get_field("quote"); ?></h1>
			  <p class="block-quote__by"><?php echo get_field("by"); ?></p>
		</div>
	</section>

	<?php
}

function render_callout_content ( $fields ) {
	?>

	<section class="callout-content">
		<div class="container">
			<div class="callout-content__block">
				<div class="callout-content__text">
					<h5><?php echo $fields["callout_content"] ?></h5>
				</div>
			</div>
		</div>
	</section>

	<?php
}

function render_column_content_simple ( $fields ) {
	?>
	<section class="simple-column-content <?php if($fields["scc_background_color"]){echo $fields["scc_background_color"] . ' ';}?><?php if($fields["scc_text_color"]){echo $fields["scc_text_color"];}?>">
		<div class="container">
			<h3 class="simple-column-content__main-title <?php echo $fields["scc_head_alignment"] ?>"><?php echo $fields["scc_main_title"] ?></h3>
			<div class="row">
				<div
					class="col-xs-12 <?php if($fields["scc_number_of_columns"] == 2){echo 'col-sm-6';} elseif($fields["scc_number_of_columns"] == 3){echo 'col-sm-4';} ?>">
					<?php if($fields["scc_column_1_title"]): ?>
					<h5 class="simple-column-content__title <?php echo $fields["header_alignment"] ?>"><?php echo $fields["scc_column_1_title"] ?></h5>
					<?php endif ?>
					<?php echo $fields["scc_column_1"] ?>
				</div>
				<div
					class="col-xs-12 <?php if($fields["scc_number_of_columns"] == 2){echo 'col-sm-6';} elseif($fields["scc_number_of_columns"] == 3){echo 'col-sm-4';} ?>">
					<?php if($fields["scc_column_2_title"]): ?>
					<h5 class="simple-column-content__title <?php echo $fields["header_alignment"] ?>"><?php echo $fields["scc_column_2_title"] ?></h5>
					<?php endif; ?>
					<?php echo $fields["scc_column_2"] ?>
				</div>
				<?php if($fields["scc_number_of_columns"] == 3) : ?>
				<div class="col-xs-12 col-sm-4 ?>">
					<?php if($fields["scc_column_3_title"]): ?>
					<h5 class="simple-column-content__title <?php echo $fields["header_alignment"] ?>"><?php echo $fields["scc_column_3_title"] ?></h5>
					<?php endif; ?>
					<?php echo $fields["scc_column_3"] ?>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</section>

	<?php
}

function render_cards_showcase ( $fields ) {
	?>
	<section class="cards">
		<div class="container">
			<h5><?php echo $fields["cards_small_heading"] ?></h5>
			<h2><?php echo $fields["cards_large_heading"] ?></h2>
			<?php if(!empty($fields["card_list"])) : ?>
				<ul class="three-up">
					<?php foreach ($fields["card_list"] as $item): ?>
						<li>
							<div class="bg-contain" style="background-image: url('<?php echo $item["card_background"] ?>');">
								<?php if(!empty($item["card_icon"])) : ?>
									<img src="<?php echo $item["card_icon"] ?>">
								<?php endif; ?>
								<h5><?php echo $item["card_label"] ?></h5>
								<div class="content">
									<hr>
									<p><?php echo $item["card_content"] ?></p>
									<?php render_link($item["card_link"]) ?>
								</div>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
			<?php endif; ?>
		</div>

		<script>
			jQuery(document).ready(function($) {
				$('.cards .three-up .content').data('height', )
			});
		</script>
	</section>

	<?php
}

function render_featured_posts ( $fields ) {
	$query_tree = explode(',', $fields["fp_query"]["category"]);
	?>

		<section class="featured-posts blog">
			<div class="container">
				<?php render_basic_content($fields["fp_content"]) ?>
				<ul class="list 3_col mt-8 md:flex">
					<?php get_paginated_posts(array(
						'post_type' => $query_tree[0],
						'posts_per_page' => $fields["fp_query"]["number_of_posts"],
						'tax_query' => array(
							array(
								'taxonomy' => $query_tree[1],
								'field' => 'slug',
								'terms' => $query_tree[2]
							)
						)
					), 'image_bg', 'n.d.y') ?>
				</ul>
			</div>
		</section>

	<?php
}

function render_form ( $fields ) {
	?>

		<section class="render-form">
			<div class="container">
				<?php render_basic_content($fields) ?>
				<?php render_gravityform($fields["form"], array('ajax')) ?>
			</div>
		</section>

	<?php
}

function render_full_image ( $fields ) {
	?>
	<section class="callout-content">
		<div class="full-width-image" style="background-image: url('<?php echo $fields['full_image']['url'] ?>')">
	</section>

	<?php
}

function render_image_content ( $fields ) {
	?>
	  <?php if (!empty(get_field('aic_sections'))) : ?>
		<section class="alt-content section--no-pad">
			<?php if (is_page_template('templates/services.php')) : ?>
				<div class="container">
					<div class="sidebar">
						<div class="sidebar__title">
						  <span class="sidebar__title-text">Our Packages</span>
						</div><!-- /.sidebar__title -->
					</div><!-- /.sidebar -->
				</div><!-- /.container -->
			<?php endif; ?>

			<div class="container-fluid container--no-pad-md">
				<div class="sections">
				<?php $i = 0; ?>
				<?php foreach (get_field("aic_sections") as $section): ?>
					<li>
						<div>
							<div class="jarallax image js-reveal <?php if ($i % 2 == 0) { echo 'js-reveal--dark'; }?>" style="background-image:url('<?php echo $section["image"] ?>');">
						  </div>
							<div class="content js-reveal-text">
								<div>
									<?php if(!empty($section["heading"])) : ?>
										<h3 class="alt-content__heading"><?php echo $section["heading"] ?></h3>
									<?php endif; ?>

									<?php if(!empty($section["content"])) : ?>
										<div class="format-content"><?php echo $section["content"] ?></div>
									<?php endif; ?>

									<?php if(!empty($section["link"])) : ?>
										<?php render_link($section["link"]) ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</li>
					<?php $i++; ?>
				<?php endforeach  ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

	<?php
}

function render_inline_cta ( $fields ) {
	?>

	<section class="inline-cta">
		<div class="container">
			<div class="wrapper">
				<div>
					<h3><?php echo $fields["inline_cta_heading"] ?></h3>
					<p><?php echo $fields["inline_cta_content"] ?></p>
				</div>
				<?php render_link($fields["inline_cta_button"]) ?>
			</div>
		</div>
	</section>

	<?php
}

function render_simple_cta ( $fields ) {
	?>

	<section class="simple-cta">
		<div class="container">
			<h3><?php echo get_field("simple_cta_heading") ?></h3>
			<?php render_link(get_field("simple_cta_button")) ?>
		</div>
	</section>

	<?php
}

function render_link_list ( $fields ) {
	?>

		<section class="link-list">
			<div class="container bigger narrow">
				<?php if(!empty($fields["heading"])) : ?>
					<?php render_basic_content($fields) ?>
				<?php endif; ?>
				<ul class="two-up">
					<?php foreach ($fields["links"] as $link): ?>
						<li>
							<a href="<?php echo $link["link"]["url"] ?>"><?php echo $link["link"]["title"] ?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</section>

	<?php
}

function render_related_links ( $fields ) {
	$is_module = in_array('related_links', $fields);
	?>

		<?php if($is_module) : ?>
			<section id="relateditems" class="related-links">
				<div class="container">
		<?php endif; ?>

					<?php if($fields["related_links_heading"]) : ?>
					<h2 class="sec-heading"><?php echo $fields["related_links_heading"]; ?></h2>
					<?php else : ?>
					<?php render_basic_content(array('heading' => 'Related Links')) ?>
					<?php endif; ?>
					<ul class="three-up">
						<?php foreach ($fields["links"] as $link): ?>
							<li>
								<?php render_card_markup($link, 'image_bg') ?>
							</li>
						<?php endforeach ?>
					</ul>
					
		<?php if($is_module) : ?>
				</div>
			</section>
		<?php endif; ?>

	<?php
}

function render_social_links () {
	?>

		<section class="social-links">
			<div class="container">
				<ul>
					<li>
						<a href="#">
							<?php get_template_part( "vector/icon-facebook" ) ?>
						</a>
					</li>
					<li>
						<a href="#">
							<?php get_template_part( "vector/icon-instagram" ) ?>
						</a>
					</li>
				</ul>
			</div>
		</section>

	<?php
}

function render_video_gallery ( $fields ) {
	?>

		<section class="video-gallery">
			<div class="container">
				<div class="video-gallery__block">

					<div class="video-gallery__content">
						<?php render_basic_content($fields["vg_content"]) ?>
					</div>

					<div class="video-gallery__container">
						<div class="video-gallery__slider">

							<?php $i = 0 ?>
							<?php foreach ($fields["vg_videos"] as $vid): ?>

								<div class="slide__wrapper">
									<div class="slide__thumb">
										<div class="slide__thumb-image ar-16:9" style="background-image:url('<?= wp_get_attachment_image_src($vid["thumbnail"], 'medium')[0] ?>');"></div>
										<div class="slide__play" data-modal-id="modal-<?= esc_attr($i) ?>"></div>
									</div>
									<div class="slide__title">
										<?= $vid["name"] ?>
									</div>
								</div>

								<?php $i++ ?>
							<?php endforeach ?>

						</div>
					</div>
				</div>
			</div>

			<div class="video-gallery__modals">

				<?php $i = 0 ?>
				<?php foreach ($fields["vg_videos"] as $vid): ?>

					<?php
					$slug = sanitize_title($vid["name"]);
					?>

					<div id="modal-<?= esc_attr($i) ?>" class="slide__modal">
						<div class="ar-16:9">
							<?= $vid["embed"] ?>
						</div>
					</div>

					<?php $i++ ?>
				<?php endforeach ?>

			</div>

			<script>
				jQuery(document).ready(function($) {

					$('.video-gallery__slider').slick({
						infinite: true,
						slidesToShow: 2,
						slidesToScroll: 2,
						arrows: false,
						infinite: false,
						responsive: [
						    {
								breakpoint: 768,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
								}
							}
						]
					})

					$.messyModals({
						openers: '.slide__play',
						videoOnly: true
					})

				});
			</script>
		</section>

	<?php
}

?>