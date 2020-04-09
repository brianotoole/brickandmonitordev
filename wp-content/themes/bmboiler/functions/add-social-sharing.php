<?php

function spx_social_sharing_buttons($content) {
	global $post;
	if(is_singular()){
	
		// Get current page URL 
		$spxURL = urlencode(get_permalink());
 
		// Get current page title
		$spxTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
		// $spxTitle = str_replace( ' ', '%20', get_the_title());
		
		// Get Post Thumbnail for pinterest
		$spxThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$spxTitle.'&amp;url='.$spxURL.'&amp;via=spx';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$spxURL;
		$googleURL = 'https://plus.google.com/share?url='.$spxURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$spxURL.'&amp;text='.$spxTitle;
		$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$spxURL.'&amp;title='.$spxTitle;
		$whatsappURL = 'https:wa.me/?text='.$spxTitle . ' ' . $spxURL;
		
		// Based on popular demand added Pinterest too
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$spxURL.'&amp;media='.$spxThumbnail[0].'&amp;description='.$spxTitle;
 
		// Add sharing button at the end of page/page content
		$variable .= '<div class="spx-social"><div class="container"><span>Share:</span> ';
		$variable .= '<a class="spx-link spx-twitter" href="'. $twitterURL .'" target="_blank"><svg width="28px" height="28px" viewBox="0 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><polygon id="path-1" points="0.000466666667 0 28 0 28 28 0.000466666667 28"></polygon></defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="JOF_BlogDetail_R3" transform="translate(-753.000000, -575.000000)"><g id="Share" transform="translate(657.000000, 575.000000)"><g id="Group-3" transform="translate(96.000000, 0.000000)"><mask id="mask-2" fill="white"><use xlink:href="#path-1"></use></mask><g id="Clip-2"></g><path d="M21.0774667,11.2525 C21.2909667,15.9658333 17.7758,21.2205 11.5516333,21.2205 C9.6593,21.2205 7.89996667,20.6651667 6.41713333,19.7143333 C8.19513333,19.9243333 9.96963333,19.4296667 11.3778,18.3271667 C9.91246667,18.3003333 8.67463333,17.3308333 8.2453,15.9996667 C8.77263333,16.1 9.28946667,16.0708333 9.7608,15.9425 C8.14846667,15.6181667 7.03546667,14.1668333 7.0728,12.614 C7.52546667,12.8648333 8.04113333,13.0153333 8.58946667,13.0328333 C7.09846667,12.0353333 6.67613333,10.0648333 7.55346667,8.55866667 C9.20546667,10.5863333 11.6741333,11.9198333 14.4601333,12.0598333 C13.9713,9.9645 15.5603,7.945 17.7256333,7.945 C18.6869667,7.945 19.5584667,8.35216667 20.1709667,9.00316667 C20.9339667,8.85383333 21.6514667,8.57383333 22.2989667,8.19 C22.0481333,8.97283333 21.5173,9.6285 20.8243,10.0438333 C21.5021333,9.96216667 22.1496333,9.7825 22.7493,9.51533333 C22.3013,10.1896667 21.7331333,10.78 21.0774667,11.2525 M14.0004667,0 C6.26896667,0 0.000466666667,6.2685 0.000466666667,14 C0.000466666667,21.7315 6.26896667,28 14.0004667,28 C21.7319667,28 28.0004667,21.7315 28.0004667,14 C28.0004667,6.2685 21.7319667,0 14.0004667,0" id="Fill-1" fill="#FFFFFF" mask="url(#mask-2)"></path></g></g></g></g></svg></a>';
		$variable .= '<a class="spx-link spx-facebook" href="'.$facebookURL.'" target="_blank"><svg width="28px" height="28px" viewBox="0 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="svg-fb" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="fb-svg" transform="translate(-705.000000, -575.000000)" fill="#FFFFFF"><g id="Share" transform="translate(657.000000, 575.000000)"><path d="M65.5,9.33333333 L63.925,9.33333333 C63.2973333,9.33333333 63.1666667,9.59116667 63.1666667,10.241 L63.1666667,11.6666667 L65.5,11.6666667 L65.2561667,14 L63.1666667,14 L63.1666667,22.1666667 L59.6666667,22.1666667 L59.6666667,14 L57.3333333,14 L57.3333333,11.6666667 L59.6666667,11.6666667 L59.6666667,8.974 C59.6666667,6.91016667 60.7528333,5.83333333 63.2005,5.83333333 L65.5,5.83333333 L65.5,9.33333333 Z M62,0 C54.2685,0 48,6.2685 48,14 C48,21.7315 54.2685,28 62,28 C69.7315,28 76,21.7315 76,14 C76,6.2685 69.7315,0 62,0 Z" id="fb-fill"></path></g></g></g></svg></a>';
		//$variable .= '<a class="spx-link spx-whatsapp" href="'.$whatsappURL.'" target="_blank">WhatsApp</a>';
		//$variable .= '<a class="spx-link spx-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
		//$variable .= '<a class="spx-link spx-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
		$variable .= '<a class="spx-link spx-linkedin" href="'.$linkedInURL.'" target="_blank"><svg width="28" height="28" xmlns="http://www.w3.org/2000/svg"><g><title>background</title><rect fill="none" id="canvas_background" height="30" width="30" y="-1" x="-1"/></g><g><title>Layer 1</title><path stroke="null" id="svg_1" fill-rule="evenodd" clip-rule="evenodd" fill="#ffffff" d="m21.691988,20.452396l0,-5.377076c0,-2.880904 -1.538013,-4.221501 -3.58839,-4.221501c-1.654626,0 -2.396086,0.910412 -2.809284,1.549031l0,-1.328659l-3.117345,0c0.04132,0.880111 0,9.378205 0,9.378205l3.117345,0l0,-5.237507c0,-0.279597 0.020201,-0.559653 0.10284,-0.759824c0.224963,-0.560112 0.737787,-1.139966 1.598615,-1.139966c1.128488,0 1.579333,0.85991 1.579333,2.120162l0,5.017594l3.116886,0l0,-0.000459zm-12.799021,-10.658199c1.086709,0 1.763894,-0.7208 1.763894,-1.621111c-0.020201,-0.919594 -0.677185,-1.619734 -1.743234,-1.619734s-1.763435,0.699681 -1.763435,1.619734c0,0.900311 0.676726,1.621111 1.723033,1.621111l0.019742,0zm5.069015,17.941034c-7.606506,0 -13.773249,-6.166742 -13.773249,-13.773249c0,-7.606965 6.166742,-13.773249 13.773249,-13.773249s13.773249,6.166283 13.773249,13.773249c0,7.606506 -6.166742,13.773249 -13.773249,13.773249zm-3.510342,-7.282835l0,-9.378205l-3.116886,0l0,9.378205l3.116886,0z"/></g></svg></a>';
		$variable .= '<a class="spx-link spx-pinterest" href="'.$pinterestURL.'" data-pin-custom="true" target="_blank"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02"><defs><style>.cls-1{fill:#fff;}</style></defs><title>PinterestIcon</title><path class="cls-1" d="M17,0A17,17,0,1,0,34,17,17,17,0,0,0,17,0Zm0,25.47a8.67,8.67,0,0,1-2.41-.35,7.26,7.26,0,0,0,.85-1.82c.11-.38.6-2.34.6-2.34A2.46,2.46,0,0,0,18.13,22c2.73,0,4.59-2.49,4.59-5.83a5.09,5.09,0,0,0-5.39-4.87c-4,0-6.07,2.9-6.07,5.31A3.27,3.27,0,0,0,13,19.88a.29.29,0,0,0,.42-.21L13.6,19a.44.44,0,0,0-.12-.48,2.42,2.42,0,0,1-.56-1.67,4,4,0,0,1,4.18-4.07c2.28,0,3.54,1.4,3.54,3.26,0,2.45-1.08,4.52-2.7,4.52a1.31,1.31,0,0,1-1.34-1.64,17.75,17.75,0,0,0,.75-3,1.14,1.14,0,0,0-1.14-1.28c-.91,0-1.64.94-1.64,2.2a3.25,3.25,0,0,0,.27,1.34s-.93,3.95-1.1,4.64a7.27,7.27,0,0,0-.14,1.95,8.49,8.49,0,1,1,3.41.72Z"/></svg></a>';
		$variable .= '</div></div>';
		
		return $variable.$content;
	}else{
		// if not a post/page then don't include sharing button
		return $variable.$content;
	}
};

add_shortcode('social_sharing', 'spx_social_sharing_buttons');

?>