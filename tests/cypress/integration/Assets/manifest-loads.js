describe('Asset manifest file is created & accessible', () => {

  it('Check if asset manifest file can be accessed', () => {

    const themeName = Cypress.env('themeName')
    const baseUrl   = Cypress.config().baseUrl
    const pattern   = baseUrl + '/app/themes/' + themeName + '/dist/manifest.json'

    cy.visit('/').then( () => {
      cy.request( pattern )
    } )
  })
})