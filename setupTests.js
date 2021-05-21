import '@testing-library/jest-dom/extend-expect'
import { Twig } from 'twig-testing-library'

/**
 * Setup twig namespaces for include paths.
 */
global.twigNamespaces = {
  components: './views/components',
  layouts: './views/layouts',
  icons: './assets/images',
}

/**
 * Mock common translation functions.
 */
Twig.extendFunction('__', (string, domain) => string)

/**
 * Mock responsive image functions, as they are PHP functions
 * outside of js-twig context.
 */
Twig.extendFunction('responsive_image', (id, mobileImage, desktopImage) => `printed image of id ${id} and sizes ${mobileImage} & ${desktopImage}`)

Twig.extendFunction('responsive_background', (id, mobileImage, desktopImage, selector) => `printed background image of id ${id} and sizes ${mobileImage} & ${desktopImage} with selector ${selector}`)

/**
 * Mock TimberImage
 */
Twig.extendFunction('TimberImage', (id) => {
  return {
    src: `src for timber image with id ${id}`,
    alt: `alt-text for timber image with id ${id}`
  }
})

/**
  * Mock social share function calls.
  */
Twig.extendFunction('facebook_share', () => 'https://facebook-share-link.dev')
Twig.extendFunction('twitter_share', () => 'https://twitter-share-link.dev')
Twig.extendFunction('linkedin_share', () => 'https://linkedin-share-link.dev')
Twig.extendFunction('whatsapp_share', () => 'https://whatsapp-share-link.dev')
