describe('Styles file loaded', () => {

  let stylesMain = ""

  it('Check if main styles file is enqueued in DOM', () => {

    const themeName = Cypress.env('themeName')
    const baseUrl   = Cypress.config().baseUrl
    const pattern   = 'link[href*="' + baseUrl + '/app/themes/' + themeName + '/dist/styles/main.'

    cy.visit('/').then( () => {
      cy.get( pattern ).then( stylesheet => {
        stylesMain = stylesheet.attr('href')
      } )
    } )
  })

  it('Check if main styles file can be accessed', () => {
    cy.request( stylesMain )      
  })
}