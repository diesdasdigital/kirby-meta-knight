<?php

Kirby::plugin('diesdasdigital/meta-knight', [
    'sections' => [
        'google_search_preview' => require_once __DIR__ . '/sections/google_search_preview.php',
        'facebook_sharing_preview' => require_once __DIR__ . '/sections/facebook_sharing_preview.php',
        'twitter_card_preview' => require_once __DIR__ . '/sections/twitter_card_preview.php'
    ],
    'blueprints' => [
        'seo' => __DIR__ . '/blueprints/seo.yml',
        'fields/basic_meta' => __DIR__ . '/blueprints/fields/basic_meta.yml',
        'fields/open_graph' => __DIR__ . '/blueprints/fields/open_graph.yml',
        'fields/twitter' => __DIR__ . '/blueprints/fields/twitter.yml',
        'fields/robots' => __DIR__ . '/blueprints/fields/robots.yml',
        'fields/profile' => __DIR__ . '/blueprints/fields/profile.yml',
        'files/seo-image' => __DIR__ . '/blueprints/files/seo-image.yml',
    ],
    'snippets' => [
        'meta_information' => __DIR__ . '/snippets/meta_information.php',
        'robots' => __DIR__ . '/snippets/robots.php'
    ],
    'translations' => [
        'en' => [
            'metaknight.meta_description_missing' => 'Description Missing.',
            'metaknight.meta_keywords_missing' => 'Keywords Missing.',
        ],
    ],
    'options' => [
      'siteTitleAfterPageTitle' => true,
      'siteTitleAsHomePageTitle' => false,
      'canonicalURLIncludesWWW' => false
    ],
    'pageMethods' => [
      'canonicalUrl' => function () {
          if (option('diesdasdigital.meta-knight.canonicalURLIncludesWWW') === false) { 
            return preg_replace(array('/http:/', '/www\./'), array('https:',''), $this->url());
          } else {
            return preg_replace('/http(s)?:\/\/(www.)?/', 'https://www.', $this->url());
          }
      }
    ]
]);
