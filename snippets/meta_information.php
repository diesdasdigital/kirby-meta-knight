<!-- Basic Meta Information -->

<!-- Page Title -->

<title><?= $page->title() ?> - <?= $site->title()?></title>
<meta itemprop="name" content="<?= $page->title() ?> | <?= $site->title() ?>">

<!-- Description -->

<?php if ($page->meta_description()->isNotEmpty()): ?>
  <meta name="description" content="<?= $page->meta_description() ?>">
  <meta itemprop="description" content="<?= $page->meta_description() ?>">
<?php else: ?>
  <meta name="description" content="<?= $site->meta_description() ?>">
  <meta itemprop="description" content="<?= $site->meta_description() ?>">
<?php endif; ?>

<!-- Keywords -->

<?php if ($page->meta_keywords()->isNotEmpty()): ?>
  <meta name="keywords" content="<?= $page->meta_keywords() ?>">
<?php else: ?>
  <meta name="keywords" content="<?= $site->meta_keywords() ?>">
<?php endif; ?>

<!-- Image -->

<?php if ($page->meta_image()->isNotEmpty()): ?>
  <meta itemprop="image" content="<?= $page->meta_image() ?>">
<?php else: ?>
  <meta itemprop="image" content="<?= $site->meta_image() ?>">
<?php endif; ?>

<!-- Author -->

<?php if ($page->meta_author()->isNotEmpty()): ?>
  <meta name="author" content="<?= $page->meta_author() ?>">
<?php else: ?>
  <meta name="author" content="<?= $site->meta_author() ?>">
<?php endif; ?>

<meta name="date" content="<?= $page->modified('Y-m-d') ?>" scheme="YYYY-MM-DD">

<!-- Twitter Card -->

<meta name="twitter:card" content="summary">

<?php if ($page->twitter_title()->isNotEmpty()): ?>
  <meta name="twitter:title" content="<?= $page->twitter_title() ?>">
<?php else: ?>
  <meta name="twitter:title" content="<?= $site->twitter_title() ?>">
<?php endif; ?>

<?php if ($page->twitter_description()->isNotEmpty()): ?>
  <meta name="twitter:description" content="<?= $page->twitter_description() ?>">
<?php else: ?>
  <meta name="twitter:description" content="<?= $site->twitter_description() ?>">
<?php endif; ?>

<?php if ($page->twitter_image()->isNotEmpty()): ?>
  <meta name="twitter:image" content="<?= $page->twitter_image()->toFile()->thumb('twitter_image')->url() ?>">
<?php else: ?>
  <meta name="twitter:image" content="<?= $site->twitter_image()->toFile()->thumb('twitter_image')->url() ?>">
<?php endif; ?>

<?php if ($page->twitter_site()->isNotEmpty()): ?>
  <meta name="twitter:site" content="<?= $page->twitter_site() ?>">
<?php else: ?>
  <meta name="twitter:site" content="<?= $site->twitter_site() ?>">
<?php endif; ?>

<?php if ($page->twitter_creator()->isNotEmpty()): ?>
  <meta name="twitter:creator" content="<?= $page->twitter_creator() ?>">
<?php else: ?>
  <meta name="twitter:creator" content="<?= $site->twitter_creator() ?>">
<?php endif; ?>

<!-- Open Graph -->

<?php if ($page->og_title()->isNotEmpty()): ?>
  <meta property="og:title" content="<?= $page->og_title() ?> | <?= $site->title() ?>">
<?php else: ?>
  <meta property="og:title" content="<?= $site->og_title() ?> | <?= $site->title() ?>">
<?php endif; ?>

<?php if ($page->og_description()->isNotEmpty()): ?>
  <meta property="og:description" content="<?= $page->og_description() ?>">
<?php else: ?>
  <meta property="og:description" content="<?= $site->og_description() ?>">
<?php endif; ?>

<?php if ($page->og_image()->isNotEmpty()): ?>
  <meta property="og:image" content="<?= $page->og_image()->toFile()->thumb('og_image')->url() ?>">
<?php else: ?>
  <meta property="og:image" content="<?= $site->og_image()->toFile()->thumb('og_image')->url() ?>">
<?php endif; ?>

<?php if ($page->og_site_name()->isNotEmpty()): ?>
  <meta property="og:site_name" content="<?= $page->og_site_name() ?>">
<?php else: ?>
  <meta property="og:site_name" content="<?= $site->og_site_name() ?>">
<?php endif; ?>

<?php if ($page->og_url()->isNotEmpty()): ?>
  <meta property="og:url" content="<?= $page->og_url() ?>">
<?php else: ?>
  <meta property="og:url" content="<?= $page->url() ?>">
<?php endif; ?>

<?php if ($page->og_type()->isNotEmpty()): ?>
  <meta property="og:type" content="<?= $page->og_type() ?>">
<?php else: ?>
  <meta property="og:type" content="<?= $site->og_type() ?>">
<?php endif; ?>

<?php if ($page->og_determiner()->isNotEmpty()): ?>
  <meta property="og:determiner" content="<?= $page->og_determiner() ?>">
<?php else: ?>
  <meta property="og:determiner" content="<?= $site->og_determiner() ?>">
<?php endif; ?>

<?php if ($page->og_audio()->isNotEmpty()): ?>
  <meta property="og:audio" content="<?= $page->og_audio() ?>">
<?php endif; ?>

<?php if ($page->og_video()->isNotEmpty()): ?>
  <meta property="og:video" content="<?= $page->og_video() ?>">
<?php endif; ?>

<meta property="og:locale" content="en_US">
