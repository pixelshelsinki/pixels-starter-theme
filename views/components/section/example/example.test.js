import { render } from 'twig-testing-library'

describe('Example section', () => {
  test('Should render with all content', async () => {
    const { container } = await render(
      './views/components/section/example/example.twig',
      {
        section: {
          title: 'Title of section',
          content: 'Content of the seciton',
          button: {
            link: 'http://pixels.fi',
            title: 'Click me',
          },
        },
      },
      twigNamespaces,
    )

    expect(container).toMatchSnapshot()
  })

  test('Should render with partial content', async () => {
    const { container } = await render(
      './views/components/section/example/example.twig',
      {
        section: {
          title: 'Title of section',
        },
      },
      twigNamespaces,
    )

    expect(container).toMatchSnapshot()
  })
})
