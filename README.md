# Pixels Starter Theme
---

This is the starter theme for Pixels website projects that are built on WordPress.

*Currently the Pixels Start Theme is still in beta, until the last few things have been finished.*

## Requirements
---

To install this theme the server instance must have the following setup:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](http://php.net/manual/en/install.php) >= 7.0

To develop this theme you must also have the following:

* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install) >= 1.0

## Theme Installation
---

*Hopefully in a future update this will be automated in some way*

1. Download this repository as a ZIP (don't clone!).
2. Drop it into the theme folder of your WordPress installation and rename the folder to `<client or project name>-theme`.
3. Open the theme in your favourite text editor.
4. Search `pixels-text-domain`and replace with `<client or project>-theme` through the entire theme directory. This should be the same as the theme folder name name from step 2.
5. Update `Theme Name` and `Description` in `style.css`. Note don't call the theme '<Project name> theme', call it simply the name of the client or project.

## Theme Development
---

To start developing do the following:

1. Update `assets/config.json` settings:
  * `devUrl` should be your development URL.
  * `publicPath` should match the path to this theme in your WordPress install.
2. In Terminal run `yarn` in the theme directory to install dependencies.

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
---
