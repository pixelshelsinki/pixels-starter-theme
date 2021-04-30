// Common
import { makeEmbedsResponsive } from './common/video-embeds'

// Imports.
import $ from 'jquery' // eslint-disable-line

const pixelsThemeApp = (function main() {
  const handleResponsiveVideos = () => {
    const videos = document.querySelectorAll('iframe[src*="youtube"], iframe[src*="vimeo"]')
    makeEmbedsResponsive(videos)
  }

  // Page load actions.
  const init = () => {
    handleResponsiveVideos()
  }

  // Scroll actions.
  const scroll = () => {

  }

  // Resize screen actions.
  const resize = () => {

  }

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
