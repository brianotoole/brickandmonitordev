/*********************************************************
	Nav.js
*********************************************************/

// Uses headroom.js
// https://wicky.nillia.ms/headroom.js/
import Headroom from "headroom.js";

var header = document.querySelector("header");
var headroom = new Headroom(header);
headroom.init();

// Nav toggle on click event
var trigger = $("#js-nav-toggle");

trigger.click(function() {
  $("#js-nav-mobile").toggleClass("nav-open");
  $("#js-nav-toggle").toggleClass("active");
  $("body").toggleClass("nav-open");
});

function navClose() {
  $("#js-nav-mobile").removeClass("nav-open");
  $("#js-nav-toggle").removeClass("active");
  $("body").removeClass("nav-open");
}

// Close on click outside
$(".nav-open-overlay").click(function() {
  navClose();
});

// Close on esc
$(document).on("keyup", function(e) {
  if (e.keyCode == 27) {
    navClose();
  }
});
