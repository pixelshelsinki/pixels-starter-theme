describe('Styles file loaded', () => {

  it('Check if main styles file can be accessed', () => {

    const themeName = Cypress.env('themeName')
    const baseUrl   = Cypress.config().baseUrl
    const pattern   = 'link[href*="' + baseUrl + '/app/themes/' + themeName + '/dist/styles/main.'

    cy.visit('/').then( () => {
      cy.get( pattern ).then( stylesheet => {
        cy.request( stylesheet.attr('href') )
      } )
    } )
  })
}