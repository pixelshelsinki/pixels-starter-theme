# Pixels Starter Theme

This is the starter theme for Pixels website projects that are built on WordPress.
**Please use the [latest release](https://github.com/pixelshelsinki/pixels-starter-theme/releases/latest)**, not master.

## Updates
Minor updates and additions will added to the current major release as long as they don't break backwards compatibility, in accordance with semantic versioning.

Every 6 months a full check of the theme will be done, to update to new versions of dependencies etc.

## Issues, improvements and these instructions.
Please read the documentation below before using. **If things are not clear or you find a mistake, or simply a way to improve the theme, please submit an issue or pull request.**

*Currently the Pixels Start Theme is still in beta, until the last few things have been finished.*

## Tools and Technologies

This theme uses the following:

* Sass for stylesheets
* ES6 for Javascript
* Webpack for compiling assets
* Browsersync for synchronised browser testing
* Timber Twig as a templating engine
* Boostrap 4 Beta as a CSS framework

## Requirements

To install this theme the server instance must have the following setup:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](http://php.net/manual/en/install.php) >= 7.0

To develop this theme you must also have the following:

* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install) >= 1.0

## Theme Installation

*Hopefully in a future update this will be automated in some way*

1. Download this repository as a ZIP (don't clone!).
2. Drop it into the theme folder of your WordPress installation and rename the folder to `<client or project name>-theme`.
3. Open the theme in your favourite text editor.
4. Search `pixels-text-domain`and replace with `<client or project>-theme` through the entire theme directory. This should be the same as the theme folder name name from step 2.
5. Update `Theme Name` and `Description` in `style.css`. Note don't call the theme '<Project name> theme', call it simply the name of the client or project.

## Theme Development

To start developing do the following:

1. Update `assets/config.json` settings:
  * `devUrl` should be your development URL.
  * `publicPath` should match the path to this theme in your WordPress install.
2. In Terminal run `yarn` in the theme directory to install dependencies.

*It may be possible in the future to have a local config that allows you to have different devUrl if needed*

### Build Commands

* `yarn run start` -- Compile assets when file changes are made, start Browsersync session
* `yarn run build` -- Compile and optimize the files in your assets directory
* `yarn run build:production` -- Compile assets for production

### Lint Commands

Lint commands check that code is structured and written nicely. If the commands above return lint errors, run one of the following (based on the error) to get a more detailed explanation.

* `yarn run lint` -- Checks JS and SCSS for errors, formatting and other issues.
* `yarn run lint:scripts` -- Checks JS *only* for errors, formatting and other issues.
* `yarn run lint:styles` -- Checks *SCSS* for errors, formatting and other issues.

## Theme Structure

The theme structure is kept simple, sticking to a relatively familiar WordPress structure for the most part. However we try and follow a React Redux-style for components and views, so everything is kept in one package as much as possible.

```
pixels-starter-theme/            # -> Theme root folder
|-- assets/                      # -> Front-end assets
  |-- config.json                # -> Settings for compiled assets
  |-- build/                     # -> Webpack and Lint config
  |-- fonts/                     # -> Theme fonts
  |-- images/                    # -> Theme images
  |-- scripts/                   # -> Theme JS
  |-- styles/                    # -> Theme general styles
|-- components/                  # -> Components used in the theme
  |-- component/                 # -> Type of component
    |-- component.scss           # -> SCSS file for a component (if required)
    |-- component.twig           # -> Twig template file for a component (required)
    |-- component-variation.twig # -> Twig template file for a component variation. May extend the base component or be completely independent.
|-- dist/                        # -> Compiled assets (never edit). Always reference assets from here (never assets/)
|-- lib/                         # -> Theme PHP
  |-- assets.php                 # -> PHP functions for fetching assets correctly
  |-- customizer.php             # -> PHP required for customizer !! Not in use currently
  |-- filters.php                # -> PHP filters !! Not in use currently
  |-- timber.php                 # -> PHP for setting up Timber on the theme side
  |-- widget-areas.php           # -> PHP for setting up widget areas
|-- node_modules/                # -> Node modules used for theme development (never edit)
|-- vendor                       # -> Composer dependencies (never edit) !! Not sure if used.
|-- views/                       # -> Views used in the theme
  |-- view/                      # -> Type of view
    |-- view.scss                # -> SCSS file for a view (if required)
    |-- view.twig                # -> Twig template file for a view (required)
```

### assets/

`assets/` is where all global SCSS, JS, images and font files should live. From here filesa are compiled to the `dist/` directory.

Any references to assets (in particular font files and images) should be made via the `dist/` directory, **not** the `assets/` directory. This is because assets in the `dist/` directory have been optimised.

### components/ and views/

`components/` are where all reusable components live and `views/` where views live. Each broad component and view has its own directory, in which there is *at least* a twig template file, and optionally a SCSS file.

#### Twig files

Twig files should start with a DocBlock explaining what the component is, any link references (e.g. Bootstrap documentation), version and variables available (to be used when calling with `{% include 'file/file.twig' with { variable: value } %}`)

An additional block should be added with default values for when the file is auto-included in the Pattern Library.

See `input/input.twig` or `single/single.twig` for an example.

#### SCSS files

SCSS files should start with a CSS comment block with a simple heading.

SCSS files must be included explicitly in `assets/styles/main.scss`.

This theme uses a linter that will force certain styling of SCSS and JS. This is to ensure more consistent and better structured SCSS.

*in the future JS files will also be put here*

### dist/

`dist/`is where the assets are compiled to. As mentioned in `assets/`, any reference to asset files should be made via `dist/` and **not** `assets/`.

### lib/

`lib/` is where the PHP setup functionality related to the theme lives.

*currently files in here are still being finalised, but this shouldn't affect the use of the theme*
