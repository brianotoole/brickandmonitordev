
<?php if(!empty(get_field('testimonial'))) : ?>
<section class="section--md section--no-pad-top section-testimonials">
  <div class="container" id="scrolling-section">
    <div id="background-scroller"></div>
    <div class="sidebar swiper-sidebar slider-testimonials">
      <div class="swiper-controls">
        <div class="swiper-button-next swiper-button-next2"></div>
        <div class="swiper-hr"></div>
        <div class="swiper-button-prev swiper-button-prev2"></div>
      </div><!-- /.swiper-controls -->
      <div class="sidebar__title swiper-title">
        <span class="sidebar__title-text">Testimonial</span>
      </div><!-- /.sidebar__title -->
    </div><!-- /.sidebar -->
    <div class="text-overlay container">
      <div class="testimonials">
        <div class="row">
          <div class="swiper-container slider-testimonials">
            <div class="swiper-wrapper testimonial">
              <?php if( have_rows('testimonial') ):
                  while ( have_rows('testimonial') ) : the_row();
                  $text = get_sub_field('text');
                  $author = get_sub_field('author');
                  $company = get_sub_field('company');
              ?>
              <div class="swiper-slide" data-id="<?php echo $testimonial_id; ?>">
                <div class="slide-inner">
                  <p class="testimonial__text text-overlay"><?php echo $text; ?>
                  </p>
                  <h4 class="testimonial__author"><?php echo $author; ?></h4>
                  <div class="testimonial__company"><?php echo $company; ?></div>
                  <div class="swiper-pagination"></div>
                </div>

              </div><!-- /.swiper-slide -->
            <?php endwhile; else: ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
            </div><!-- /.swiper-wrapper -->

          </div><!-- /.swiper-container -->
        </div><!-- /.row -->
      </div><!-- /.testimonials -->
    </div>
  </div>
</section>
<?php endif; ?>


<script>
var swiperTestimonials = new Swiper('.slider-testimonials', {
  loop: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next2',
    prevEl: '.swiper-button-prev2',
  },
});
</script>