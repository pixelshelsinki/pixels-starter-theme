// Common
import { makeEmbedsResponsive } from './common/video-embeds'

// Imports.
import $ from 'jquery' // eslint-disable-line
import 'bootstrap'

const pixelsThemeApp = (function main() {
  // Page load actions.
  const init = () => {
    makeEmbedsResponsive()
  }

  // Scroll actions.
  const scroll = () => {

  }

  // Resize screen actions.
  const resize = () => {

  }

  /* Functions */

  // Exports to DOM binds.
  return { init, scroll, resize }
}())

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
