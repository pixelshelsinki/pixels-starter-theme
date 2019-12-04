document.addEventListener('DOMContentLoaded', () => {
    const embed_videos = document.querySelectorAll( 'iframe[src*="youtube"], iframe[src*="vimeo"]' );

    embed_videos.forEach( video => {
        
        // Remove enforced height & width
        video.removeAttribute('height');
        video.removeAttribute('width');

        // Wrap video html in wrapper
        let wrapper = document.createElement('div');
        wrapper.classList.add('video-wrap');
        video.parentNode.insertBefore( wrapper, video );
        wrapper.appendChild( video );
    } )
});