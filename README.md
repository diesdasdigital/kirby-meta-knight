# Meta Knight – SEO for Kirby

Meta Knight is a SEO and Social Media Sharing Plugin for Kirby. Meta Knight makes it easier to work with meta information in Kirby's panel.

Meta Knight provides blueprints, snippets and custom preview sections. At the moment it covers:

-   Basic Meta Information + Google Search Preview
-   Open Graph + Facebook Sharing Preview
-   Twitter Cards + Twitter Cards Preview
-   Robots

All of the above is neatly organized in a ready-made SEO tab that can be added to any blueprint.

![Screenshot](screenshot.gif)

This plugin was originally developed at [diesdas.digital] by Jonathan Muth, Lorenz Seeger and Leslie Büttel. Meta Knight exists because we wanted to standardize the way we handle meta informaton across all our projects.

---

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-meta-knight`.

### Git submodule

```bash
git submodule add https://github.com/diesdasdigital/kirby-meta-knight.git site/plugins/kirby-meta-knight
```

### Composer (not available yet)

```bash
composer require diesdasdigital/kirby-meta-knight
```

## Setup

How to add SEO to Kirby:

Add this tab to your site.yml: `seotab: seo` (The site meta information is what Kirby SEO falls back to when no meta information is provided for a page)

Add this tab to all your pages: `seotab: seo`

Example:

```yaml
title: Site

tabs:
    content:
        icon: text
        label: Content
        sections:
            drafts:
                headline: Drafts
                type: pages
                status: draft
                templates:
                    - default
                    - masthead
                image:
                    query: false
            unlisted:
                headline: Unlisted
                type: pages
                status: unlisted
                image:
                    query: false
            listed:
                headline: Listed
                type: pages
                status: listed
                image:
                    query: false

    seotab: seo
```

Add these two snippets to your head: `<?php snippet('meta_information'); ?>` + `<?php snippet('robots'); ?>`

## Options

_Document the options and APIs that this plugin offers_

## Development

_Add instructions on how to help working on the plugin (e.g. npm setup, Composer dev dependencies, etc.)_

### Development

You can start the dev process with …

```bash
yarn dev
```

This will automatically update the `index.js` and `index.css` of your plugin as soon as you make changes.
It will also enable hot module reloading in the panel. Reload the panel once and afterwards you should
see changes immediately without further reloading.

### Production

As soon as you are happy with your plugin, you should build the final version with

```bash
yarn build
```

This will automatically create a minified and optimized version of your `index.js` and `index.css`
which you can ship with your plugin.

We have a tutorial on how to build your own plugin based on the Pluginkit [in the Kirby documentation](https://getkirby.com/docs/guide/plugins/plugin-setup-basic).

## License

MIT

## Credits

-   [diesdas ⚡️ digital](https://github.com/diesdasdigital)
