<?php
	
	// Fetch a modular component from the component library
	function get_component ( $layout_name = null ) {
		
		if (!empty($layout_name)) {
			
			get_template_part( 'components/' . $layout_name );
			return true;
		} else {

			throw new Exception(`Warning: No layout name given for get_component()`);
			return false;
		}

	}

	function return_link ( $link, $tag = 'a' ) {
		
		$html = '<' . $tag . ' href="' . esc_url($link["url"]) . '"';
		if (!empty($link["target"])) {
			$html .= ' target="' . esc_attr($link["target"]) .  '"';
		}
		if (!empty($link["linkClass"])) {
			$html .= ' class="' . esc_attr($link["linkClass"]) . '"';
		}
		$html .= '>' . esc_html($link["title"]) . '</' . $tag . '>';

		return $html;

	}

	function render_link ( $link, $tag = 'a' ) {
		
		echo return_link($link, $tag);

	}

	// Render a gravityform
	function render_gravityform ( $form, $options = array() ) {

		if (!empty($form)) {

			if (gettype($form) == 'object') {
				$form_id = $form->id;
			} elseif (gettype($form) == 'array') {
				$form_id = $form["id"];
			} else {
				return false;
			}

			echo do_shortcode('[gravityform id="'. $form_id .'" title="'. (in_array('title', $options) ? 'true' : 'false') .'" description="'. (in_array('description', $options) ? 'true' : 'false') .'" ajax="'. (in_array('ajax', $options) ? 'true' : 'false') .'"]');

		}

	}

	// Render card markup for blog and other list items
	function render_card_markup ( $fields, $style ) {

		?>

		<?php if ($style === 'card') : ?>

			<div class="wrapper card">
				<a href="<?php echo $fields["link"] ?>">
					<div class="card__thumb" style="background-image: url('<?php echo $fields["thumb_url"] ?>');"></div>
					<div class="card__meta">
						<p class="card__date"><strong><?php echo $fields["date"] ?></strong></p>
					</div>
					<h4 class="card__title"><?php echo $fields["title"] ?></h4>
					<p><?php echo $fields["excerpt"] ?></p>
					<span class="link btn inline blue">Read More</span>
				</a>
			</div>

		<?php elseif ($style === 'image_bg') : ?>

			<div class="wrapper image-bg">
				<a href="<?php echo $fields["link"] ?>">
					<h5 class="image-bg__title"><?php echo $fields["title"] ?></h5>
					<p class="image-bg__date"><?php echo $fields["date"] ?></p>
					<p class="image-bg__excerpt"><?php echo $fields["excerpt"] ?></p>
					<span class="link btn">Read More</span>
				</a>
			</div>

		<?php elseif ($style === 'slide') : ?>

			<div class="wrapper bg-contain" style="background-image: url('<?php echo $fields["thumb_url"] ?>');">
				<h3><?php echo $fields["title"] ?></h3>
				<p><?php echo $fields["excerpt"] ?></p>
				<a href="<?php echo $fields["link"] ?>" class="btn green">Read More</a>
			</div>

		<?php endif; ?>

		<?php

	}

	function render_blockquote ( $content = '', $footer = null ) {

		if (empty($content)) {
			return;
		}
		?>

			<blockquote>
				<?php echo $content ?>
				<footer><?php echo $footer ?></footer>
			</blockquote>

		<?php
	}

	function render_filter ( $filter ) {

		/*

		The blog class will use these to create tax_query objects
		input name attributes are taxonomy name
		input value attributes are the term ID

		*/

		?>

		<div id="<?php echo $filter["taxonomy"]["name"] ?>" class="filter">
			<h5><?php echo (!empty($filter["heading"]) ? $filter["heading"] : $filter["taxonomy"]["title"]) ?></h5>

			<select name="<?php echo $filter["taxonomy"]["name"] ?>">
				<option selected value>All</option>
				<?php foreach ($filter["taxonomy"]["terms"] as $term) : ?>
					<option value="<?php echo $term->term_id ?>"><?php echo $term->name ?></option>
				<?php endforeach ?>
			</select>

		</div>

		<?php

	}

	// Get all taxonomies and their terms for a given post type. Accepts pt object or name
	function get_post_type_taxonomies ( $post_type ) {

		if (gettype($post_type) == 'object') {

			$post_type = $post_type->name;

		}
			
		$obj_taxonomies = get_object_taxonomies( $post_type, $output = 'objects' );

		$taxonomies = array();
		foreach ($obj_taxonomies as $tax) {
			$taxonomies[$tax->name] = array(
				'name' => $tax->name,
				'title' => $tax->label,
				'labels' => $tax->labels,
				'terms' => get_terms( array('taxonomy' => $tax->name, 'hide_empty' => false))
			);
		}

		return $taxonomies;

	}

	function get_paginated_posts_json ( $payload ) {

		$args = $payload["query"];
		$filters = $payload["user_filters"];

		$args["tax_query"] = array('relation' => 'AND');
		foreach ($filters as $tax => $terms) {
			if (!empty($terms)) {
				if ($terms != 'all') {
					array_push($args["tax_query"], array(
						'taxonomy' => $tax,
						'field' => 'slug',
						'terms' => $terms
					));
				}
			}
		}

		$postQuery = new WP_Query($args);

		$result = array(
			'query' => $args,
			'total_posts' => (int)$postQuery->found_posts,
			'posts' => array()
		);

		if($postQuery->have_posts()) :
			while ( $postQuery->have_posts() ) :
				$postQuery->the_post();

				$post["link"] = get_the_permalink();
				$post["thumb_url"] = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
				$post["date"] = get_the_date('n.d.y');
				$post["title"] = get_the_title();
				$text = strip_shortcodes( get_the_content() );
				$text = apply_filters( 'the_content', $text );
				$text = str_replace(']]>', ']]&gt;', $text);
				$text = str_replace('&nbsp;', '', $text);
				$excerpt_length = apply_filters( 'excerpt_length', 35 );
				$excerpt_more = apply_filters( 'excerpt_more', '' . '...' );
				$post["excerpt"] = wp_trim_words( $text, $excerpt_length, $excerpt_more );

				array_push($result["posts"], $post);

			endwhile;
		endif;
		
		wp_reset_query();

		return $result;

	}

	function get_paginated_tributes_json ( $payload ) {

		$args = $payload["query"];
		$filterBy = $payload["filterBy"];

		// $args["meta_query"] = array('relation' => 'AND');
		if (strlen($filterBy["letter"]) > 0 && $filterBy["letter"] != 'Any') {
			$args["post_title_like"] = $filterBy["letter"];
		}
		if (strlen($filterBy["name"]) > 0) {
			$args["s"] = $filterBy["name"];
		}
		if (strlen($filterBy["region"]) > 0) {
			$args["meta_query"] = array(
				'relation' => 'OR',
				array(
					'key' => 'donor_city',
					'value' => $filterBy["region"],
					'compare' => 'IN'
				),
				array(
					'key' => 'donor_state',
					'value' => $filterBy["region"],
					'compare' => 'IN'
				)
			);
		}

		$postQuery = new WP_Query($args);

		$result = array(
			'query' => $args,
			'total_posts' => (int)$postQuery->found_posts,
			'posts' => array()
		);

		if($postQuery->have_posts()) :
			while ( $postQuery->have_posts() ) :
				$postQuery->the_post();

				$post["link"] = get_the_permalink();
				$post["image"] = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
				if (empty($post["image"])) {
					$post["image"] = home_url() . '/wp-content/uploads/old_images/'. get_field( 'donor_id' ) .'_base.jpg';
				}
				$post["date"] = get_the_date('n.d.y');
				$post["title"] = get_the_title();
				$post["excerpt"] = wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ), true ), 10, '...' );

				array_push($result["posts"], $post);

			endwhile;
		endif;
		
		wp_reset_query();

		// return $filterBy;
		return $result;

	}
 
	// Used by blog class. Query is the wp query args, include page number
	function get_paginated_posts ( $query, $style, $date_format ) {

		$args = $query;
		
		$postQuery = new WP_Query($args);

		if($postQuery->have_posts()) :
			while ( $postQuery->have_posts() ) :
				$postQuery->the_post();

				$fields["link"] = get_the_permalink();
				$fields["thumb_url"] = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
				if (empty($fields["thumb_url"])) {
					$fields["thumb_url"] = get_field( 'hero_background_image' );
				}
				$fields["date"] = get_the_date($date_format);
				$fields["title"] = get_the_title();
				$fields["excerpt"] = wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', get_the_ID() ), true ), 17, '...' );

				?><li class="md:flex md:w-1/3"><?php
				render_card_markup($fields, $style);
				?></li><?php

			endwhile;
		endif;
		
		wp_reset_query();

	}

	function var_error_log( $object=null ){
		ob_start();
		var_dump( $object );
		$contents = ob_get_contents();
		ob_end_clean();
		error_log( $contents );
	}

?>
