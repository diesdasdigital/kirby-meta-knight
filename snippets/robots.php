<?php // Robots ?>

<?php

  $robots_content = [];

  if ( param("page") !== null) {
      array_push($robots_content, "noindex");
  } elseif ($page->robots_noindex()->isNotEmpty() && $page->robots_noindex()->value() !== 'default' ) {
    if ($page->robots_noindex()->value() === 'enabled') {
      array_push($robots_content, "noindex");
    }
  } else {
    if ($site->robots_noindex()->value() === 'enabled') {
      array_push($robots_content, "noindex");
    }
  }

  if ($page->robots_nofollow()->isNotEmpty() && $page->robots_nofollow()->value() !== 'default' ) {
    if ($page->robots_nofollow()->value() === 'enabled') {
      array_push($robots_content, "nofollow");
    }
  } else {
    if ($site->robots_nofollow()->value() === 'enabled') {
      array_push($robots_content, "nofollow");
    }
  }

  if ($page->robots_noarchive()->isNotEmpty() && $page->robots_noarchive()->value() !== 'default' ) {
    if ($page->robots_noarchive()->value() === 'enabled') {
      array_push($robots_content, "noarchive");
    }
  } else {
    if ($site->robots_noarchive()->value() === 'enabled') {
      array_push($robots_content, "noarchive");
    }
  }

  if ($page->robots_noimageindex()->isNotEmpty() && $page->robots_noimageindex()->value() !== 'default' ) {
    if ($page->robots_noimageindex()->value() === 'enabled') {
      array_push($robots_content, "noimageindex");
    }
  } else {
    if ($site->robots_noimageindex()->value() === 'enabled') {
      array_push($robots_content, "noimageindex");
    }
  }

  if ($page->robots_nosnippet()->isNotEmpty() && $page->robots_nosnippet()->value() !== 'default' ) {
    if ($page->robots_nosnippet()->value() === 'enabled') {
      array_push($robots_content, "nosnippet");
    }
  } else {
    if ($site->robots_nosnippet()->value() === 'enabled') {
      array_push($robots_content, "nosnippet");
    }
  }

  $robots_content = implode(", ", $robots_content)

?>

<meta name="robots" content="<?= $robots_content ?>" />
