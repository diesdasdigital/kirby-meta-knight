<?php
  $twitter_image = [
      'width'   => 1200,
      'height'  => 675,
      'quality' => 80,
      'crop'    => true
    ];
  $og_image = [
      'width'   => 1200,
      'height'  => 630,
      'quality' => 80,
      'crop'    => true
    ];
?>

<?php // Basic Meta Information ?>
  
<?php // Schema ?>
  
<style itemscope itemtype="https://schema.org/WebSite" itemref="schema_name schema_description schema_image"></style>

<?php // Page Title ?>

<?php if(option('diesdasdigital.meta-knight.siteTitleAfterPageTitle', true)): ?>
  <title><?= $page->meta_title()->or($page->title()) ?> - <?= $site->title()?></title>
  <meta id="schema_name" itemprop="name" content="<?= $page->meta_title()->or($page->title()) ?> - <?= $site->title()?>">
<?php else: ?>
  <title><?= $site->title()?> - <?= $page->meta_title()->or($page->title()) ?></title>
  <meta id="schema_name" itemprop="name" content="<?= $site->title()?> - <?= $page->meta_title()->or($page->title()) ?>">
<?php endif; ?>
<?php // Description ?>

<meta name="description" content="<?= $page->meta_description()->or($site->meta_description()) ?>">
<meta id="schema_description" itemprop="description" content="<?= $page->meta_description()->or($site->meta_description()) ?>">

<?php // Keywords ?>

<meta name="keywords" content="<?= $page->meta_keywords()->or($site->meta_keywords()) ?>">


<?php // Canonical URL ?>
  
<link rel="canonical" href="<?= $page->meta_canonical_url()->or($page->url()) ?>" />

<?php // Image ?>

<meta id="schema_image" itemprop="image" content="<?= $page->meta_image()->or($site->meta_image()) ?>">

<?php // Author ?>

<meta name="author" content="<?= $page->meta_author()->or($site->meta_author()) ?>">

<?php // Date ?>

<meta name="date" content="<?= $page->modified('Y-m-d') ?>" scheme="YYYY-MM-DD">

<?php // Open Graph ?>

<meta property="og:title" content="<?= $page->og_title()->or($site->og_title()) ?> | <?= $site->title() ?>">

<meta property="og:description" content="<?= $page->og_description()->or($site->og_description()) ?>">

<?php if ($ogimage = $page->og_image()->toFile() ?? $site->og_image()->toFile()): ?>
  <meta property="og:image" content="<?= $ogimage->thumb($og_image)->url() ?>">
<?php endif; ?>

<meta property="og:site_name" content="<?= $page->og_site_name()->or($site->og_site_name()) ?>">

<meta property="og:url" content="<?= $page->og_url()->or($page->url()) ?>">

<meta property="og:type" content="<?= $page->og_type()->or($site->og_type()) ?>">

<?php if ($page->og_image()->or($site->og_determiner())->isNotEmpty()): ?>
  <meta property="og:determiner" content="<?= $page->og_determiner()->or($site->og_determiner())->or("auto") ?>">
<?php endif; ?>

<?php if ($page->og_audio()->isNotEmpty()): ?>
  <meta property="og:audio" content="<?= $page->og_audio() ?>">
<?php endif; ?>

<?php if ($page->og_video()->isNotEmpty()): ?>
  <meta property="og:video" content="<?= $page->og_video() ?>">
<?php endif; ?>

<?php if ($kirby->language() !== null): ?>
  <meta property="og:locale" content="<?= $kirby->language()->locale(LC_ALL) ?>">
  <?php foreach($kirby->languages() as $language): ?>
    <?php if($language !== $kirby->language()): ?>
      <meta property="og:locale:alternate" content="<?= $language->locale(LC_ALL) ?>">
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>

<?php
  $authors = $page->og_type_article_author()->or($site->og_type_article_author());
?>

<?php foreach ($authors->toStructure() as $author): ?>
  <meta property="article:author" content="<?= $author->url()->html() ?>">
<?php endforeach ?>

<?php // Twitter Card ?>

<meta name="twitter:card" content="summary">

<meta name="twitter:title" content="<?= $page->twitter_title()->or($site->twitter_title()) ?>">

<meta name="twitter:description" content="<?= $page->twitter_description()->or($site->twitter_description()) ?>">

<?php if ($twitterimage = $page->twitter_image()->toFile() ?? $site->twitter_image()->toFile()): ?>
  <meta name="twitter:image" content="<?= $twitterimage->thumb($twitter_image)->url() ?>">
<?php endif; ?>

<meta name="twitter:site" content="<?= $page->twitter_site()->or($site->twitter_site()) ?>">

<meta name="twitter:creator" content="<?= $page->twitter_creator()->or($site->twitter_creator()) ?>">
