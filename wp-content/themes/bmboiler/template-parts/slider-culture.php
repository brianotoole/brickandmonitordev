
<section class="section culture">
  <div class="container container--no-pad-right">
    <div class="sidebar">
      <div class="sidebar__title">
        <span class="sidebar__title-text">What Matters to Us</span>
      </div><!-- /.sidebar__title -->
    </div><!-- /.sidebar -->
    <div class="row swiper-container slider-culture">
        <div class="swiper-wrapper">

          <?php if( have_rows('culture-slider') ):
            while ( have_rows('culture-slider') ) : the_row();
            $img = get_sub_field('image');
            $title = get_sub_field('title');
            $subtitle = get_sub_field('subtitle');
          ?>
          <div class="swiper-slide slider-culture__slide" style="background-image:url('<?php echo $img['url']; ?>')">
            <div class="slider-culture__content">
              <h2 class="h1"><?php echo $title; ?></h2>
              <p><?php echo $subtitle; ?></p>
            </div><!-- /.slider-culture__content -->
          </div><!-- /.swiper-slide -->
          <?php endwhile; else: ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>

        </div><!-- /.swiper-wrapper -->

    </div><!-- /.row -->
  </div><!-- /.container -->
</section>



<script>
var mySwiper = new Swiper('.slider-culture', {
  slidesPerView: 'auto',
  centeredSlides: true,
  spaceBetween: 60,
  breakpoints: {
  768: {
      spaceBetween: 15,
    }
  }        
});

//mySwiper.snapGrid[mySwiper.snapGrid.length - 1] = mySwiper.slidesGrid[mySwiper.slidesGrid.length - 1];

$(".swiper-slide-next").click(function(e) {
  e.preventDefault();
  // Swipes to the next slide
  mySwiper.slideNext();
});
$(".swiper-slide-prev").click(function(e) {
  e.preventDefault();
  // Swipes to the prev slide
  mySwiper.slidePrev();
});
</script>