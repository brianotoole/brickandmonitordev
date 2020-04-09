<section class="section--lg studio-callout section--no-pad-btm" id="whatwedo">
  <div class="container">
    <div class="sidebar">
      <div class="sidebar__title">
        <span class="sidebar__title-text">What We Do</span>
      </div><!-- /.sidebar__title -->
    </div><!-- /.sidebar -->
    <div class="row parralax">
      <div class="rectangle col-sm-12 col-md-9 parralax__col js-reveal js-reveal--dark">
        <div class="parralax__col-content">
          <h2><?php the_field('blue_text') ?></h2>
        </div><!-- /content -->
      </div><!-- /.col -->
      <div data-jarallax data-speed="0.5" class="jarallax jarallax--abs col-sm-12 col-md-4 parralax__col parralax__col--abs parralax__col--img js-reveal js-reveal--abs" style="background-image:url('<?php echo get_field('studio_image')['url'] ?>');">
      </div>
    </div><!-- /.row -->
    <div class="row">
      <div class="col-sm-12 col-md-6 parralax__col parralax__col--transparent">
        <div class="parralax__col-content parralax__col-content--padded js-reveal-text">
          <?php the_field('floating_text') ?>
          <div class="button-wrapper">
            <a class="btn btn--primary from-bottom" href="<?php get_field('button_link')['url'] ?>">Get Started</a>
          </div>
        </div><!-- /content -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /container -->
</section><!-- /section -->
