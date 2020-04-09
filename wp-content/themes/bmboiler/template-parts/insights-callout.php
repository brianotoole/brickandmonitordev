<?php
  $video = get_field('insights_video');
  $video_thumbnail = $video['thumbnail'];
  $video_embed = $video['embed_code'];

  $img = get_field('insights_image');
  $quote = get_field('insights_quote');
  $quotee = get_field('insights_quotee');
  $quotee_title = get_field('insights_quotee_title');
 ?>

<section class="section--md" id="insights-callout">
  <div class="row insights-callout">
    <div data-jarallax data-speed="0.25" class="jarallax col-sm-12 col-md-7 insights-callout__video js-reveal js-reveal--dark js-reveal--on-top" style="background-image:url('<?php echo $video_thumbnail; ?>')">

      <a href="<?php echo home_url(); ?>/athletes" class="insights-callout__video-play">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" class="circle-wrap">
        <defs>
          <path id="circlePath" d="M253,421.7c-90.1-1.8-162.5-75.4-162.5-166c0-91.7,74.3-166,166-166
        s166,74.3,166,166c0,89.5-70.8,162.4-159.4,165.9"/>
        </defs>
        <circle id="circle" cx="256.5" cy="255.7" r="160" />
        <text>
          <textPath id="output" xlink:href="#circlePath" startOffset="0%" >
          View Athletes &bull; View Athletes &bull;
          </textPath>
        </text>
      </svg>
      </a>

    </div><!-- /.col -->
    <div data-jarallax data-speed="0.25" class="jarallax col-sm-12 col-md-4 insights-callout__img js-reveal" style="background-image:url('<?php echo $img; ?>')"></div>
    <div class="js-reveal-text">
      <div class="container container--push-up">
        <div class="col-md-6 col-md-offset-1 insights-callout__quote">
          <h3><?php echo $quote; ?></h3>
          <div class="insights-callout__quotee"><?php echo $quotee; ?></div>
          <a href="<?php echo home_url(); ?>/get-started" class="btn btn--primary from-bottom"><?php echo $quotee_title; ?></a>
        </div><!-- /insights-callout__quote -->
      </div><!-- /.container -->
    </div><!-- /.js-reval-text -->
  </div><!-- /.row -->
</section>
