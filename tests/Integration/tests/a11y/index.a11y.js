describe('Home page accessibility', () => {
  beforeEach(() => {
    cy.visit('/')
    cy.injectAxe()
  })

  it('Has no non-critical a11y violations on load', () => {
    cy.checkA11y(
      null,
      {
        includedImpacts: ['minor', 'moderate', 'serious'],
      },
      cy.a11yErrorLog,
    )
  })

  it('Has no critical a11y violations on load', () => {
    cy.checkA11y(
      null,
      {
        includedImpacts: ['critical'],
      },
      cy.a11yErrorLog,
    )
  })
})
