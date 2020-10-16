// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************

const a11yErrorLog = (violations) => {
  cy.task(
    'log',
    `${violations.length} accessibility violation${
      violations.length === 1 ? '' : 's'
    } ${violations.length === 1 ? 'was' : 'were'} detected`,
  )

  const violationData = violations.map(
    ({
      id, impact, description, nodes,
    }) => ({
      id,
      impact,
      description,
      nodes: nodes.length,
    }),
  )

  cy.task('table', violationData)
}

Cypress.Commands.add('a11yErrorLog', a11yErrorLog)
