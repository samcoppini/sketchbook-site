"use strict";

window.onkeydown = function (event) {
  event = event || window.event;

  var nav_bar = document.getElementsByClassName("nav-bar")[0];

  // Left arrow key pressed
  if (event.keyCode == 37) {
    // Simulates a click on the "prev" button on the navigation bar
    nav_bar.children[1].click();
  }
  // Right arrow key pressed
  else if (event.keyCode == 39) {
    // Simulates a click on the "next" button of the navigation bar
    nav_bar.children[3].click();
  }
}
