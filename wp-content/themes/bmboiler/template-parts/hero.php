<?php // HERO

// Custom Field Group == Component: Hero
$hero_background_position = get_field('hero_background_position');
$hero_image = get_field('hero_background_image');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_button = get_field('hero_button');
// get slug name via post_name property
$slug_name = get_post_field('post_name', get_post());
?>





<?php if (is_front_page()) : ?>
<section class="hero hero--home hero--full-height hero--has-overlay hero--<?php echo $hero_background_position ?>" style="background-image:url('<?php echo $hero_image['url']; ?>');">
  <div class="hero__content container js-reveal-text">
      <h1 class="hero__title"><?php echo (!empty($hero_title) ? ''.$hero_title.'' : ''.the_title().'') ?></h1>
      <p class="hero__subtitle"><?php echo $hero_subtitle; ?></p>
      <?php if ($hero_button) : ?>
      <div class="hero__btn-container">
        <a href="<?php echo $hero_button['url']; ?>" target="<?php echo $hero_button['target']; ?>" class="btn btn--transparent from-bottom"><?php echo $hero_button['title']; ?></a>
      </div><!--/.hero__btn-container-->
      <?php endif; ?>
  </div><!--/.hero__content-->
</section><!--/.hero-->

<?php else : ?>

<section class="hero hero--interior hero--<?php echo $slug_name; ?>">
  <div class="hero__content container js-reveal-text">
      <h1 class="hero__title"><?php echo (!empty($hero_title) ? ''.$hero_title.'' : ''.the_title().'') ?></h1>
      <p class="hero__subtitle"><?php echo $hero_subtitle; ?></p>
      <?php if ($hero_button) : ?>
      <div class="hero__btn-container">
        <a href="<?php echo $hero_button['url']; ?>" target="<?php echo $hero_button['target']; ?>" class="btn btn--transparent from-bottom"><?php echo $hero_button['title']; ?></a>
      </div><!--/.hero__btn-container-->
      <?php endif; ?>
  </div><!--/.hero__content-->
</section><!--/.hero-->
<?php endif; ?>

