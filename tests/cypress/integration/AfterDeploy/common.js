describe('Important pages', () => {
  it(`Visits core pages of site`, () => {

    cy.fixture('AfterDeploy/urls').then( urls => {

      const urlSet = Cypress.env('env') == 'test' ? urls.local : urls.production

      for( page in urlSet ) {
        describe(`Visiting ${page}`, () => {
          cy.visit(urlSet[page])
        }
      }
    })

  })
})