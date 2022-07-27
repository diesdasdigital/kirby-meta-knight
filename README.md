<h1 align="center">Meta Knight – SEO for Kirby</h1>

<p align="center">🔍 Manage SEO and Social Media Sharing from the <a href=https://getkirby.com>Kirby</a> panel</p>

<br>

<p align="center">
<img
  width="650"
  src="screenshot.gif"
  alt="Screenshot showing the many config fields for titles, descriptions and similar info in the panel"
>
</p>

<br>

---

<br>
<br>

Meta Knight provides blueprints, snippets and custom preview sections. At the moment the plugin covers:

- Basic Meta Information (Title, Description, Keywords, Canonical URL, etc.) + Google Search Preview
- Open Graph + Facebook Sharing Preview
- Twitter Cards + Twitter Cards Preview
- Robots Settings

All of the above is neatly organized in a pre-composed SEO tab that can easily be added to any blueprint.

<br>

- [Installation](#installation)
- [Setup](#setup)
- [Configuration](#configuration)
  - [Title options](#title-options)
  - [Homepage options](#homepage-options)
  - [Canonical URLs](#canonical-urls)
- [Sourcing SEO data from existing page content](#sourcing-seo-data-from-existing-page-content)
- [Other](#other)
  - [Development](#development)
  - [License](#license)
  - [Credits](#credits)

<br>

## Installation

You can install Meta Knight via

1. **Manual download**

Download and copy this repository to `/site/plugins/kirby-meta-knight`.

2. **Git Submodule**

```bash
git submodule add https://github.com/diesdasdigital/kirby-meta-knight.git site/plugins/kirby-meta-knight
```

3. **Composer**

```bash
composer require diesdasdigital/kirby-meta-knight
```

<br>

## Setup

After installation, follow these steps to setup your site:

**1. Add the SEO tab definition `seotab: seo` to the `tabs` section of your site's blueprint:**  
(Meta Knight uses meta information configured on the site level as fallback for individual pages)

```yaml
title: Site

tabs:
  content:
    icon: grid
    label: Overview
    sections:
      drafts:
        type: pages
        status: draft
        create: default
      published:
        type: pages
        status: published
  seotab: seo
```

**2. Add the SEO tab definition `seotab: seo` to the `tabs` section of your page blueprints:**

```yaml
title: Default
icon: 📃

tabs:
  content:
    icon: text
    columns:
      - width: 2/3
        fields:
          text:
            type: blocks
      - width: 1/3
        sections:
          pages:
            status: all
            layout: list
          files:
            layout: list
  seotab: seo
```

**3. Add these snippets to the `<head>` area of your templates:**

```php
<?= snippet('meta_information') ?>
<?= snippet('robots') ?>
```

✔ Now the panel is set up so you can enter SEO information, which the snippets then render when a page is displayed.

<br>

## Configuration

There are several configuration options available. They can be placed under the key `diesdasdigital.meta-knight` in your `config.php`:

```php
<?php

return [
    'diesdasdigital.meta-knight' => [
        'seperator' => ' - ',
        'siteTitleAfterPageTitle' => true,
        'siteTitleAsHomePageTitle' => false,
        'pageTitleAsHomePageTitle' => false,
        'canonicalURLIncludesWWW' => false,
    ],
];
```

### Title options

By default, the title will include the page title followed by the site title, divided by a separator: `<title>My Page – My Site</title>`. You can flip the order and customize the separator:

#### `seperator`

Set a custom separator, e.g. ` | `: `<title>My Page | My Site</title>`.  
Default: ` - `

#### `siteTitleAfterPageTitle`

If set to `false`, outputs the site title first: `<title>My Site – My Page</title>`.  
Default: `true`

### Homepage title

If you want a plain, single title for the homepage instead of a combination of page and site titles, you can use one of these options:

#### `siteTitleAsHomePageTitle`

If set to `true`, only display the site title for the homepage: `<title>My Site</title>`.  
Default: `false`

#### `pageTitleAsHomePageTitle`

If set to `true`, only display the page title for the homepage: `<title>Home</title>`.  
Default: `false`

> ⚠ Note that the two options are mutually exclusive, you may only set one of them to `true`.

### Canonical URLs

Meta Knight automatically normalizes page URLs for use as canonical URL, stripping the `www.` in the beginning and enforcing `https` as protocol. If you want your canonical URLs to include the `www` subdomain, use:

#### `canonicalURLIncludesWWW`

If set to `true`, `www.` is added to the beginning of canonical URLs. Otherwise it is stripped.  
Default: `false`

> **Please note** ⚠️
>
> - Auto-generated canonical URLs will always use the `https` protocol.
> - A canonical URL manually entered in the SEO Tab will override the auto-generated one.
> - Do not enable `canonicalURLIncludesWWW` if your site is running on another subdomain!

<br>

## Sourcing SEO data from existing page content

Sometimes you don't want to configure each description or sharing image manually, but instead automatically reuse a project thumbnail or use an excerpt of the page content for the description.

For this, you can use Kirby [Page Models](https://getkirby.com/docs/guide/templates/page-models) to override the methods used by Meta Knight to read the data. You can inspect the methods Meta Knight uses to access data in [`snippets/meta_information.php`](snippets/meta_information.php).

```php
<?php // site/models/default.php

class DefaultPage extends Page {
  public function meta_description() {
    return parent::meta_description()->or($your_fallback_here);
  }
}
```

> ⚠ Make sure the overridden methods continue to return `Kirby\Cms\Field` objects! (check the example for details)

### Example

A portfolio site has project pages, showcasing a `project_image` alongside a `project_description`. The respective blueprint in `site/blueprints/pages/project.yml` looks like this:

```yaml
title: Project

tabs:
  content:
    icon: text
    fields:
      project_image:
        label: Project Image
        type: files
        multiple: false
      project_description:
        label: Project Description
        type: blocks
  seotab: seo
```

We want Meta Knight to use the project image as the sharing image for Twitter and Facebook, if no other image is explicitly configured in the SEO tab. To extend the page model and adjust the methods, we need to create `site/models/project.php`:

```php
<?php

class ProjectPage extends Page {
  public function meta_image() {
    return parent::meta_image()->or(parent::project_image());
  }
  public function og_image() {
    return parent::og_image()->or(parent::project_image());
  }
  public function twitter_image() {
    return parent::twitter_image()->or(parent::project_image());
  }
}
```

Now, the page will use the `meta_image`, `og_image` and `twitter_image` fields if they were configured in the SEO tab, but use the `->or()` method to default to the `project_image` if the former isn't set!

Let's continue and make sure the project description is used as the SEO description. If we did everything as with the images above, our method on the class `ProjectPage` would look like this:

```php
  // ❌ doesn't work!
public function meta_description() {
  return parent::meta_description()->or(parent::project_description());
}
```

However, this doesn't work. The value of `project_description` isn't directly usable by Meta Knight because it is a complex field of type `blocks`. We can call `->toBlocks()->excerpt()` on the field to get a usable text value for our SEO description:

```php
// ❌ better, but still errors!
public function meta_description() {
  $excerpt = parent::project_description()->toBlocks()->excerpt();
  return parent::meta_description()->or($excerpt);
}
```

Unfortunately, there are still errors. The excerpt method returns a plain `string` value, but Meta Knight expects a `Kirby\Cms\Field` object to be returned. It needs to call methods like `->or()` and `->value()` during rendering, which aren't available on regular strings. So we need to wrap our description string in a new `Field` object:

```php
<?php

class ProjectPage extends Page {
  // ...image methods as seen above

  public function meta_description() {
    $excerpt = new Field(null, '', parent::project_description()->toBlocks()->excerpt());
    return parent::meta_description()->or($excerpt);
  }
}
```

Now the excerpt sourced from a page's `project_description` is displayed in the SEO snippet alongside the `project_image`!  
You can use the same approach to provide defaults for snippet titles, author data and any other meta information.

<br>

## Other

### Development

#### Install dependencies

```bash
yarn
```

#### Start development server

```bash
yarn dev
```

This will automatically rebuild the `index.js` and `index.css` of Meta Knight as soon as you make changes.

#### Build for production

```bash
yarn build
```

This will build minified and optimized versions of your `index.js` and `index.css` files, improving load time in production environments.

### License

MIT – See [LICENSE.md](LICENSE.md) for more info.

### Credits

This plugin was originally developed at [diesdas.digital](https://www.diesdas.digital) by Jonathan Muth, Lorenz Seeger and Leslie Büttel. Meta Knight exists because we wanted to standardize the way we handle meta information across all our projects.

We'd also like to thank @distantnative for his help along the way! Without him this plugin wouldn't be what it is today.

GitHub: [diesdas ⚡️ digital](https://github.com/diesdasdigital)
