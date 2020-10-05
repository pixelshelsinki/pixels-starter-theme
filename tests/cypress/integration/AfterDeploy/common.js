describe('Important pages', () => {
  it('Visits core pages of site', () => {
    cy.fixture('AfterDeploy/urls').then((urls) => {
      const urlSet = Cypress.env('env') === 'test' ? urls.local : urls.production

      Object.keys(urlSet).forEach((page) => {
        describe(`Visiting ${page}`, () => {
          cy.visit(urlSet[page])
        })
      })
    })
  })
})
