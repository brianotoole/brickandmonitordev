<?php // Default Page Template

// Header
get_header();

// Hero
get_template_part('template-parts/hero', '');

// Page Builder
get_template_part( "template-parts/page-builder" );

// Footer
get_footer();

?>