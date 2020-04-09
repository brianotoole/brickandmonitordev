
<?php /* Template Name: Careers */

// Header
get_header();

// Hero
get_template_part('template-parts/hero', '');

// Page Builder
//get_template_part('template-parts/page-builder');

// Alternating Content
render_image_content('');

// Accorion
get_component('accordion');

// Footer
get_footer();

?>