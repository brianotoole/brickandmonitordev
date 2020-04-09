/*********************************************************
  Main JS Entry Point
*********************************************************/

// SCSS
import './entry.scss';

// GLOBAL
//require("./global/events.js");

// COMPONENTS
require("./js/components/nav.js");
require("./js/components/social-sharing.js");
require("./js/components/bs-modal.js");

// Classes
//import Modal from "./classes/modal";s
//var modal = new Modal();

// TEMPLATES
//require('./templates/about.js');

var tl = new TimelineMax();
var steps = document.querySelectorAll(".js-reveal");
var text = document.querySelectorAll(".js-reveal-text");

var ctrl = new ScrollMagic.Controller({
  //addIndicators: true //debug only, requires 'debug.addIndicators.min.js'
});

$.each(steps, function(index, step) {
  new ScrollMagic.Scene({
    triggerElement: step,
    triggerHook: 0.8, //"onEnter",
    //offset: 100, // start after #px
    reverse: false
  })
    .setClassToggle(step, "animated")
    .addTo(ctrl);
});

$.each(text, function(index, step) {
  new ScrollMagic.Scene({
    triggerElement: step,
    triggerHook: 0.8, //"onEnter",
    //offset: 100, // start after #px
    reverse: false
  })
    .setClassToggle(step, "animated")
    .addTo(ctrl);
});

// Hero
/*
var heroItems = $(".hero > *");
heroItems.each(function() {
  tl.add(
    TweenMax.from($(this), 0.4, {
      autoAlpha: 0,
      y: -5,
      ease: Power0.easeOut
    })
  );
});
*/


// Team
/*
function staggerInTeam() {
  var teamScene = new ScrollMagic.Scene({
    //scene options
    triggerElement: "#js-stagger-items",
    triggerHook: 0.8,
    reverse: false
  })
    .setTween(tl)
    .addTo(ctrl);
  return tl.staggerFrom(".stagger-item",0.05, {
    y: 5,
    autoAlpha: 0,
    ease: Power1.easeOut
  }, 0.05);
}
staggerInTeam();
*/

// Fade Text;
$(document).ready(function() {
	$(window).scroll(function() {
    var scrollPos = $(this).scrollTop();
    $('.hero__content').css({
      //'margin-top': (scrollPos/4)+"px",
      'opacity': 1-(scrollPos/500)
    });
	});
});



// Page Loader
var loadingTime = 900;
var transitionTime = 1200;

window.setTimeout(function() {
  $("#loader").addClass("loader-hidden");

}, loadingTime);
window.setTimeout(function() {
  $("#loader").addClass("loader-displaynone");
}, loadingTime + transitionTime);


var tlLoading = new TimelineMax({repeat:-1,repeatDelay:.01,yoyo:true})
var tl = new  TimelineMax({});
tlLoading.staggerTo(".loader-text span", .5, {color: "#999",scale:1.05,}, 0.05);
//tl.from(".hero__content", .6, {autoAlpha:0,ease: Linear.easeNone})
