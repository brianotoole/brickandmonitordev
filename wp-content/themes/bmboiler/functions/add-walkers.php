<?php

class Xoo_Nav_Walker_Full extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		$classes = array( 'sub-menu' );
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul class='list'>{$n}";

	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent  = str_repeat( $t, $depth );
		$output .= "$indent</ul></div>";

		$f_id = get_field( 'header_featured_post', 'options' );
		if (!empty($f_id)) {
			$featured["title"] = get_the_title( $f_id );
			$featured["thumbnail"] = get_the_post_thumbnail_url($f_id, 'medium');
			$featured["link"] = get_the_permalink( $f_id );
			$featured["content"] = get_post_field( 'post_content', $f_id );
			$output .= "<div class='featured-post'>";
			$output .= "<h5>Featured Post</h5><hr>";
			$output .= "<a href='" . $featured["link"] . "'><img src='" . $featured["thumbnail"] . "'></a>";
			$output .= "<p class='title'><strong><a href='" . $featured["link"] . "'>" . $featured["title"] . "</a></strong></p>";
			$output .= "<p class='excerpt'>" . wp_trim_words( wp_strip_all_tags( $featured["content"], true ), 16, '...' ) . " <a href='" . $featured["link"] . "'>Read More</a></p>";
			$output .= "</div>";
		}

		$output .= "</div></div>{$n}";

	}

	public function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

		$object = $item->object;
		$type = $item->type;
		$title = $item->title;
		$description = $item->description;
		$permalink = $item->url;

		$output .= "<li class='" .  implode(" ", $item->classes) . "'>";

		//Add SPAN if no Permalink
		if( $permalink && $permalink != '#' ) {
			$output .= '<a href="' . $permalink . '">';
		} else {
			$output .= '<span class="cursor-pointer">';
		}

		$output .= $title;
		if( $description != '' && $depth == 0 ) {
			$output .= '<small class="description">' . $description . '</small>';
		}
		if( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}

		if (in_array('menu-item-has-children', $item->classes)) {
			$output .= '<div class="sub-menu"><div class="container"><div class="content"><h5>';
			if( $permalink && $permalink != '#' ) {
				$output .= '<a href="' . $permalink . '">' . $title . '</a></h5><hr>';
			} else {
				$output .= '<span>' . $title . '</span></h5><hr>';
			}
		}

	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";
	}

}

?>