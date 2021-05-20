<?php

return [
    'props' => [
        'headline' => function ($headline = 'Google Search Preview') {
            return $headline;
        }
    ],
    'computed' => [
      'title' => function () {
          return $this->model()->title();
      },
      'url' => function () {
          return $this->model()->url();
      },
      'uid' => function () {
        return $this->model()->uid();
      },
      'siteTitleAfterPageTitle' => function () {
          return option('diesdasdigital.meta-knight.siteTitleAfterPageTitle', true);
      },
      'siteTitleAsHomePageTitle' => function () {
        return option('diesdasdigital.meta-knight.siteTitleAsHomePageTitle', false);
      },
      'separator' => function () {
        return option('diesdasdigital.meta-knight.separator', ' - ');
      },
    ]
];
