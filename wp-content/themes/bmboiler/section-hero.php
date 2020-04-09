<?php
	
	// Get hero type
	$type = get_field('hero_type');
	if(!$type) {
		$type = 'tiny';
	}

	// Get hero bg image
	$background = get_field('hero_background_image');
	if(!$background) {
		$background["url"] = get_template_directory_uri() . '/library/images/default-banner.jpg';
	}

	// Get the rest of the fields
	$video = get_field('hero_background_video');
	$heading["primary"] = get_field('hero_primary_heading');
	$heading["secondary"] = get_field('hero_secondary_heading');
	$options = get_field('hero_additional_options');

?>

<section class="spx-module hero lazy-bg <?php echo $type; ?> <?php foreach($options as $opt) { echo ' '.$opt; } ?>" lazy="<?php echo $background["url"] ?>" lazy-medium="<?php echo (isset($background["sizes"]) ? $background["sizes"]["medium-large"] : $background["url"]) ?>" lazy-medium-large="<?php echo (isset($background["sizes"]) ? $background["sizes"]["medium_large"] : $background["url"]) ?>">

	<?php if($video) : ?>
		<video id="hero-video" loop="loop"></video>
		<script>
			jQuery(document).ready(function($) {
				if($(window).width() > 1024) {
					var videoURL = '<?php echo $video ?>';
					var videoType = '<?php echo substr(strrchr($video, "."), 1) ?>';
					var video = document.getElementById('hero-video');
					var source = document.createElement('source');
					source.src = videoURL;
					source.type = 'video/'+videoType;
					video.appendChild(source);
					video.load();
					video.addEventListener('loadeddata', function() {
						console.log('loaded');
						this.style.display = 'inline-block';
						this.play();
					}, false);
				}
			});
		</script>
	<?php endif; ?>

	<div class="container">
		<?php if($heading["primary"]) : ?>
			<h1><?php echo $heading["primary"]; ?></h1>
		<?php endif; ?>
		<?php if($heading["secondary"]) : ?>
			<h2><?php echo $heading["secondary"]; ?></h2>
		<?php endif; ?>
	</div>

	<div class="arrow-container"><div></div><div></div></div>
	
</section>

<script>
	jQuery(document).ready(function($) {

	    var sizes;
	    if (window.innerWidth <= 500) {
	        size = '-medium';
	    } else if (window.innerWidth <= 768) {
	        size = '-medium-large';
	    } else {
	        size = '';
	    }

	    $('.lazy').each(function(i) {
	        $(this).attr('src', $(this).attr('lazy' + size));
	    });
	    $('.lazy-bg').each(function(i) {
	    	$(this).css('background-image', 'url(' + $(this).attr('lazy' + size) + ')');
	    });

	});
</script>
