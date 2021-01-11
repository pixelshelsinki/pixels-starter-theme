import { makeEmbedsResponsive } from './video-embeds'

// DOM start state.
const startDOM = '<div class="responsive-video">'
      + '<iframe width="560" height="315" src="https://www.youtube.com/embed/CXXqe3p7dx8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
  + '</div>'

// Expected DOM end state.
const endDOM = '<div class="responsive-video">'
      + '<div class="video-wrap">'
        + '<iframe src="https://www.youtube.com/embed/CXXqe3p7dx8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>'
      + '</div>'
  + '</div>'

describe('Responsive embeds', () => {
  test('Makes youtube / vimeo iframes responsive', () => {
    // Set up our document body
    document.body.innerHTML = startDOM

    const embedVideos = document.querySelectorAll('iframe[src*="youtube"], iframe[src*="vimeo"]');
    makeEmbedsResponsive(embedVideos)

    // Assert accordion was opened
    expect(document.body.innerHTML).toEqual(endDOM)
  })
})
