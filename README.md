# Kirby Seo Plugin

### Development

You can start the dev process with …

```
yarn dev
```

This will automatically update the `index.js` and `index.css` of your plugin as soon as you make changes.
It will also enable hot module reloading in the panel. Reload the panel once and afterwards you should
see changes immediately without further reloading.

### Production

As soon as you are happy with your plugin, you should build the final version with

```
yarn build
```

This will automatically create a minified and optimized version of your `index.js` and `index.css`
which you can ship with your plugin.

We have a tutorial on how to build your own plugin based on the Pluginkit [in the Kirby documentation](https://getkirby.com/docs/guide/plugins/plugin-setup-basic).

What follows is an example README for your plugin.

---

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-seo`.

### Git submodule

```
git submodule add https://github.com/diesdasdigital/kirby-seo.git site/plugins/kirby-seo
```

### Composer

```
composer require diesdasdigital/kirby-seo
```

## Setup

_Additional instructions on how to configure the plugin (e.g. blueprint setup, config options, etc.)_

## Options

_Document the options and APIs that this plugin offers_

## Development

_Add instructions on how to help working on the plugin (e.g. npm setup, Composer dev dependencies, etc.)_

## License

MIT

## Credits

[diesdas ⚡️ digital](https://github.com/diesdasdigital)
