<?php if (!empty(get_field('overlapping_images'))) : ?>
<section class="section--sm">
  <div class="container-fluid container--no-pad-md">
    <div class="overlap-images">
      <?php $i = 0; ?>
      <?php foreach (get_field("overlapping_images") as $section): ?>
				<div data-jarallax data-speed="0.5" class="jarallax col-sm-12 col-md-9 overlap-images__item js-reveal <?php if ($i % 2 == 1) { echo 'overlap-images__item--abs js-reveal--dark col-sm-12 col-md-4'; } ?>" style="background-image:url(<?php echo $section["image"]['url'] ?>)">
        </div>
				<?php $i++; ?>
			<?php endforeach  ?>
    </div><!-- /.sections -->
  </div><!-- /.container-fluid -->
</section>
<?php endif; ?>