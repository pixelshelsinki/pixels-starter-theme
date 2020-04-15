describe('Scripts file loaded', () => {

  it('Check if main JS file can be accessed', () => {

    const themeName = Cypress.env('themeName')
    const baseUrl   = Cypress.config().baseUrl
    const pattern   = 'script[src*="' + baseUrl + '/app/themes/' + themeName + '/dist/scripts/main.'

    cy.visit('/').then( () => {
    	cy.get( pattern ).then( script => {
    		cy.request( script.attr('src') )
    	} )
    } )
  })
})