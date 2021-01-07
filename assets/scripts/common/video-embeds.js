/**
 * Make video embeds responsive
 */
export const makeEmbedsResponsive = (videos) => {
  videos.forEach((video) => {
    // Remove enforced height & width
    video.removeAttribute('height');
    video.removeAttribute('width');

    // Wrap video html in wrapper
    const wrapper = document.createElement('div');
    wrapper.classList.add('video-wrap');
    video.parentNode.insertBefore(wrapper, video);
    wrapper.appendChild(video);
  })
}

export default makeEmbedsResponsive
