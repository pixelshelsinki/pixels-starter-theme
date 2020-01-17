// Common
import './common/video-embeds.js'

// Imports.
import $ from 'jquery' // eslint-disable-line
import 'bootstrap'

const pixelsThemeApp = function() {  

  // Page load actions.
  const init = () => {

  }

  // Scroll actions.
  const scroll = () => {

  }

  // Resize screen actions.
  const resize = () => {

  }

  /* Functions */

  // Exports to DOM binds.
  return {init:init,scroll:scroll,resize:resize}
}()


/**
 * DOM listener binds
 * --> Init
 * --> Scroll
 * --> Resize
 */
document.addEventListener('DOMContentLoaded', () => {
  pixelsThemeApp.init()
})

window.addEventListener('scroll', () => {
  pixelsThemeApp.scroll();
})

window.addEventListener('resize', () => {
  pixelsThemeApp.resize();
})
