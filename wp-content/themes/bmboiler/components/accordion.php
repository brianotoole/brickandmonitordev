
<section class="section section--no-pad-btm careers">
<div class="container">
  <div class="row">
    <h2 class="section-title h1">Career Opportunities</h2>
  </div><!-- /.row -->
</div><!-- /.container -->

<?php
  $categories = get_terms('career_category');
  foreach ( $categories as $category ) {
    $query = new WP_Query( array(
      'post_type' => 'career',
      'tax_query' => array(
        array(
          'taxonomy' => 'career_category',
          'field' => 'slug',
          'terms' => array( $category->slug ),
          'operator' => 'IN'
        )
      )
  ));
?>

<ul class="accordion accordion-careers">
    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <li class="accordion__item accordion-container">
      <h5 class="accordion__title"><?php the_title(); ?></h5>
      <p class="accordion__content"><?php the_content(); ?></p>
    </li><!-- /.accordion__item -->
    <?php endwhile; endif; ?>
</ul><!-- /.accordion -->

<?php } ?>


</section>



<script>
(function($) {
    $('.accordion > .accordion__item:eq(0) a').addClass('active').next().slideDown();

    $('.accordion .accordion__title').click(function(j) {
        var dropDown = $(this).closest('li').find('p');

        $(this).closest('.accordion').find('.accordion__content').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
})(jQuery);
</script>