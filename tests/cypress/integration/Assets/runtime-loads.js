describe('Runtime.js file loaded', () => {

  let runtime = ""

  it('Check if runtime.js file is enqueued in DOM', () => {

    const themeName = Cypress.env('themeName')
    const baseUrl   = Cypress.config().baseUrl
    const pattern   = 'script[src*="' + baseUrl + '/app/themes/' + themeName + '/dist/runtime.'

    cy.visit('/').then( () => {
    	cy.get( pattern ).then( script => {
        runtime = script.attr('src')
    	} )
    } )
  })

  it('Check if mruntime.js file can be accessed', () => {
    cy.request( runtime )    
  })
})