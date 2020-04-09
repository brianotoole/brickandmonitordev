<?php

$args = array(
  'post_type' => 'portfolio',
  'posts_per_page' => 50
  );
  $portfolio_query = new WP_Query( $args );
?>

<section class="section--no-pad-top-md">
  <div class="container container--no-pad-right-md">
    <div class="sidebar swiper-sidebar">
      <div class="sidebar__title swiper-title">
        <span class="sidebar__title-text">Work</span>
      </div><!-- /.sidebar__title -->
      <div class="swiper-controls">
        <div class="swiper-button-next"></div>
        <div class="swiper-hr"></div>
        <div class="swiper-button-prev"></div>
      </div><!-- /.swiper-controls -->
      <div class="swiper-item-title" data-title=""></div>
    </div><!-- /.sidebar -->
    <div class="row">
        <div class="swiper-container slider-work">
          <div class="swiper-wrapper">
          <?php if ( $portfolio_query->have_posts() ) : while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>
          <?php $portfolio_id = $post->ID; ?>
            <div class="swiper-slide js-reveal" data-title="<?php echo the_title();?>">
              <div class="slide-inner" style="background-image:url('<?php the_field('portfolio_image'); ?>');'"></div>
            </div><!-- /.swiper-slide -->
          <?php endwhile; else: ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
          </div><!-- /.swiper-wrapper -->

        </div><!-- /.swiper-container -->
    </div><!-- /.row -->
  </div><!-- /container -->
</section><!-- /section -->


<script>
var interleaveOffset = 0.5;

var swiperOptions = {
  loop: true,
  speed: 1000,
  grabCursor: false,
  watchSlidesProgress: true,
  mousewheelControl: true,
  keyboardControl: true,
  touchRatio: 0,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  on: {
    progress: function() {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        var slideProgress = swiper.slides[i].progress;
        var innerOffset = swiper.width * interleaveOffset;
        var innerTranslate = slideProgress * innerOffset;
        swiper.slides[i].querySelector(".slide-inner").style.transform =
          "translate3d(" + innerTranslate + "px, 0, 0)";
      }
    },
    touchStart: function() {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        swiper.slides[i].style.transition = "";
      }
    },
    setTransition: function(speed) {
      var swiper = this;
      for (var i = 0; i < swiper.slides.length; i++) {
        swiper.slides[i].style.transition = speed + "ms";
        swiper.slides[i].querySelector(".slide-inner").style.transition =
          speed + "ms";
      }
    },
    slideChange: function () {
    },
  }
};
var swiper = new Swiper(".slider-work", swiperOptions);
var swiperButtons = $(".swiper-button-next, .swiper-button-prev")

swiper.on('touchEnd', () => {
  var activeTitle = $('.swiper-slide-active').attr('data-title');
  $('.swiper-item-title').text(activeTitle);
})

swiperButtons.click(function() {
  var activeTitle = $('.swiper-slide-active').attr('data-title');
  $('.swiper-item-title').text(activeTitle);
});

var activeTitle = $('.swiper-slide-active').attr('data-title');
$('.swiper-item-title').text(activeTitle);
</script>
