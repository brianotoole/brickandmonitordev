<?php 
//check for the video type:  currently there are options for Vimeo and Youtube
$videoType = get_field('select_video_type');

//add the correct id based on the video type selecte
$videoID = ($videoType == 'youtube' ? get_field('youtube_id') : get_field('vimeo_id'));
$videoClass = $videoType;

//get the video screenshot and alt text
$screenshotID = get_field('video_screenshot');
$imgObj = wp_get_attachment_image_src($screenshotID, 'banner', false);
$imgAlt = get_post_meta($screenshotID, '_wp_attachment_image_alt', true);
$imgURL = $imgObj[0];

//only display the below code if there is a videoID present
if($videoID): ?>

	<div id="video-block-container" style="background-image:url(<?= $imgURL ?>)">
		<?php // this is where the actual video is displayed.  This is hidden until the play button is clicked. ?>
		<div id="banner-video-container" class="hide">
			<div id="video-close-button" class="<?= $videoClass ?>"><?php print do_shortcode('[icon name="close" class="fa-times "]'); ?></div>
			
			
			<?php 
			//display the correct iframe based on the video type selected.
			if($videoType == 'youtube'): ?>
				
				<iframe id="video-player" width="90%" height="90%" src="http://www.youtube.com/embed/<?= $videoID ?>?enablejsapi=1&amp;rel=0&amp;autoplay=0&amp;controls=1&amp;autohide=1&amp;modestbranding=1&amp;nologo=1&amp;showinfo=0&amp;loop=1" frameborder="0" allowfullscreen></iframe>
				
			<?php elseif($videoType == 'vimeo'): ?>
				
				<iframe id="video-player" src="//player.vimeo.com/video/<?= $videoID ?>?api=1" width="90%" height="90%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				
			<?php endif; ?>
			
		</div>
		
		<div id="video-playbutton-container">
			<?php //this is the play button for non touch devices.  This opens the video in the section on the page using jquery and/or javascript.  The youtube code is called at the bottom of the page but the vimeo code is in the scripts.js file. ?>
			<div id="video-play-button" class="video-play-button <?= $videoClass ?>">
				<?php print do_shortcode('[icon name="play" class="fa-play-circle "]'); ?>
			</div>
			
			<?php //for touch devices we will just have a link to the video since it will probably open in the native app. ?>
		  <div id="video-play-button-touch" class="video-play-button">
			  <?php 
			  	$baseURL = '';
				
			  	if($videoType == 'youtube'){
			  		$baseURL = 'https://www.youtube.com/watch?v=';
			  	}
				elseif($videoType == 'vimeo'){
			  		$baseURL = 'https://vimeo.com/';
				}
					
			  ?>
			  
			  <a href="<?= $baseURL . $videoID ?>" target="_blank"><?php print do_shortcode('[icon name="play" class="fa-play-circle "]'); ?></a>

		  </div>
		</div>
		
		<div id="video-overlay"></div>		
	</div>
	
	<?php 
	//this code is specific to the youtube video and allows us to stop and start the video when a button is clicked.  the vimeo version of this is in the scripts.js file.
	if($videoType == 'youtube'): ?>
    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('video-player', {
			events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
					  
	  // bind events
	    var playButton = document.getElementById("video-play-button");
	    playButton.addEventListener("click", function() {
			player.seekTo(0);
			event.target.unMute();
	        player.playVideo();				  
	    });

	    var stopButton = document.getElementById("video-close-button");
	    stopButton.addEventListener("click", function() {
			player.stopVideo();
	    });


      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
       //   setTimeout(stopVideo, 6000);
          done = true;
        }
      }

    </script>
	<?php endif; ?>
	  
	  
<?php endif; ?>