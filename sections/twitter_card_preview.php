<?php

return [
    'props' => [
        'headline' => function ($headline = 'Basic Meta') {
            return $headline;
        }
    ],
    'computed' => [
      'title' => function () {
          return $this->model()->title();
      },
      'url' => function () {
          return $this->model()->url();
      }
    ]
];
