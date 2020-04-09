<?php

// Header
get_header();

// Hero
get_template_part('template-parts/hero', '');

// Hero-Below
get_template_part('template-parts/portfolio-meta', '');
?>

<?php if(!empty(get_field('quote'))) : ?>
<section class="section--sm" id="project-overview">
  <div class="container">
    <div class="section--md">
		  <p class="block-quote__quote"><?php echo get_field("quote"); ?></p>
    </div><!-- /.blockquote -->
  </div><!-- /.container -->
</section>
<?php endif; ?>

<?php

// Hero
get_template_part('template-parts/slider', '');

// Overlapping Images
get_template_part('template-parts/overlap-images', '');

// Alternating Content
render_image_content('');

// BG
get_template_part('template-parts/scrolling-background-testimonials', '');

// Footer
get_footer();

?>