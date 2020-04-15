describe('Scripts file loaded', () => {

  let scriptsMain = ""

  it('Check if main JS file is enqueued in DOM', () => {

    const themeName = Cypress.env('themeName')
    const baseUrl   = Cypress.config().baseUrl
    const pattern   = 'script[src*="' + baseUrl + '/app/themes/' + themeName + '/dist/scripts/main.'

    cy.visit('/').then( () => {
    	cy.get( pattern ).then( script => {
        scriptsMain = script.attr('src')
    	} )
    } )
  })

  it('Check if main JS file can be accessed', () => {
    cy.request( scriptsMain )    
  })
})