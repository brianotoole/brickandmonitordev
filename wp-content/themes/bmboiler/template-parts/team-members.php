<?php
  $team_query = new WP_Query( array(
    'post_type' => 'team',
  ));
  $i = 1;
 ?>
<section id="team-members" class="section--no-pad-top">

  <div class="container">
    <div class="sidebar">
			<div class="sidebar__title">
				<span class="sidebar__title-text">Meet the Team</span>
			</div><!-- /.sidebar__title -->
    </div><!-- /.sidebar -->
  </div><!-- /.container -->

  <div class="container" id="js-stagger-items">
    <div class="row row-1-7">
    <?php if ( $team_query->have_posts() ) : while ( $team_query->have_posts() ) : $team_query->the_post();
       $img = get_field('team_img')['url'];
       $title = get_field('team_title');
       $bio = get_field('team_bio');
      ?>
      <div class="col-1-7 team-member stagger-item">
        <a href="" data-toggle="modal" data-target="#modal-<?php echo $i; ?>">
          <img class="team-member__img" src="<?php echo $img; ?>">
        </a>
        <div class="team-member__name team-member__name--outer"><?php the_title(); ?></div>
      </div><!-- /.col -->

      <div id="modal-<?php echo $i; ?>" class="modal modal-team fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="col-xs-12 col-sm-5 modal-team__left">
              <img class="modal-team__left-img" src="<?php echo $img; ?>" />
              <div class="modal-team-pad">
                <div class="modal-team__left-name"><strong><?php the_title(); ?></strong></div>
                <div class="modal-team__left-certs"><?php echo $certs; ?></div>
                <div class="modal-team__left-location">
                  <?php
                    $categories = get_the_terms($post->ID, 'team_category' );
                    foreach ($categories as $category) {
                      $categories_formatted = strtolower(str_replace(', ', '', $category->name));
                      echo '<span class="color-'.$categories_formatted.'">'.$category->name.'</span>';
                    }
                  ?>
                </div>
                <div class="modal-team__left-title"><?php echo $title; ?></div>
              </div><!-- /.modal-team-pad -->
            </div><!-- /.col -->
            <div class="col-xs-12 col-sm-7 modal-team__right">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <div class="modal-body">
              <?php echo $bio; ?>
              </div><!-- /.modal-body -->
            </div><!-- /.col -->
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dailog -->
      </div><!-- /.modal -->
      <?php
         $i++;
         endwhile; else :
         endif;
         wp_reset_query();
      ?>
    </div><!--/ .row --> 
  </div><!-- /.container -->



</section>
