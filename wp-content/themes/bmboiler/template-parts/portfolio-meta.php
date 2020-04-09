<?php
  $args = array(
    'post_type' => 'portfolio',
    );
  $query = new WP_Query( $args );
?>
<div class="container">
  <div class="row">
    <div class="portfolio-meta container">
    <?php
      $types = get_the_terms($post->ID, 'portfolio_category' );
        foreach ($types as $type) {
          echo '<div class="portfiolo-meta__type">'.$type->name.'</div>';
        }
      ?>

      <h1 class="portfolio-meta__title h2"><?php the_title(); ?></h1>

      <?php
      $cities = get_the_terms($post->ID, 'portfolio_city_category' );
        foreach ($cities as $city) {
          echo '<div class="portfiolo-meta__city">'.$city->name.'</div>';
        }
      ?>

      <a href="#" target="_blank" class="portfiolo-meta__tags">View Website</a>


    </div><!-- /.portfolio-meta -->
  </div>
</div>