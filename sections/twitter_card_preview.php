<?php

return [
    'props' => [
        'headline' => function ($headline = 'Twitter Card Preview') {
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
      'siteTitleAfterPageTitle' => function () {
          return option('diesdasdigital.meta-knight.siteTitleAfterPageTitle', true);
      }
    ]
];
