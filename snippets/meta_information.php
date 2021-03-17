<?php
  $twitter_image_thumb = [
      'width'   => 1200,
      'height'  => 675,
      'quality' => 80,
      'crop'    => true
    ];
  $og_image_thumb = [
      'width'   => 1200,
      'height'  => 630,
      'quality' => 80,
      'crop'    => true
    ];
    
  if(option('diesdasdigital.meta-knight.siteTitleAsHomePageTitle', true) && $page->isHomePage()) {
    $full_title = $site->meta_title()->or($site->title());
  } elseif (option('diesdasdigital.meta-knight.siteTitleAfterPageTitle', true)) {
    $full_title =  $page->meta_title()->or($page->title()) . ' - ' . $site->meta_title()->or($site->title());
  } else {
    $full_title =  $site->meta_title()->or($site->title()) . ' - ' . $page->meta_title()->or($page->title());
  }

?>

<?php // Basic Meta Information ?>
  
<?php // Schema ?>
  
<style itemscope itemtype="https://schema.org/WebSite" itemref="schema_name schema_description schema_image"></style>

<?php // Page Title ?>

<?php if(option('diesdasdigital.meta-knight.siteTitleAfterPageTitle', true)): ?>
  <title><?= $full_title ?></title>
  <meta id="schema_name" itemprop="name" content="<?= $full_title ?>">
<?php else: ?>
  <title><?= $full_title ?></title>
  <meta id="schema_name" itemprop="name" content="<?= $full_title ?>">
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

<meta property="og:title" content="<?= $page->og_title()->or($page->meta_title())->or($page->title()) ?>">

<meta property="og:description" content="<?= $page->og_description()->or($page->meta_description())->or($site->meta_description()) ?>">

<?php if ($og_image = $page->og_image()->toFile() ?? $site->og_image()->toFile()): ?>
  <meta property="og:image" content="<?= $og_image->thumb($og_image_thumb)->url() ?>">
  <meta property="og:width" content="<?= $og_image->thumb($og_image_thumb)->width() ?>">
  <meta property="og:height" content="<?= $og_image->thumb($og_image_thumb)->height() ?>">
<?php endif; ?>

<meta property="og:site_name" content="<?= $page->og_site_name()->or($site->og_site_name()) ?>">

<meta property="og:url" content="<?= $page->og_url()->or($page->url()) ?>">

<meta property="og:type" content="<?= $page->og_type()->or($site->og_type()) ?>">

<?php if ($page->og_determiner()->or($site->og_determiner())->isNotEmpty()): ?>
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
  $og_authors = $page->og_type_article_author()->or($site->og_type_article_author());
?>

<?php foreach ($og_authors->toStructure() as $og_author): ?>
  <meta property="article:author" content="<?= $og_author->url()->html() ?>">
<?php endforeach ?>

<?php // Twitter Card ?>

<meta name="twitter:card" content="<?= $page->twitter_card_type()->or($site->twitter_card_type())->value() ?>">

<meta name="twitter:title" content="<?= $page->twitter_title()->or($page->meta_title())->or($page->title()) ?>">

<meta name="twitter:description" content="<?= $page->twitter_description()->or($page->meta_description())->or($site->meta_description()) ?>">

<?php if ($twitter_image = $page->twitter_image()->toFile() ?? $site->twitter_image()->toFile()): ?>
  <meta name="twitter:image" content="<?= $twitter_image->thumb($twitter_image_thumb)->url() ?>">
<?php endif; ?>

<meta name="twitter:site" content="<?= $page->twitter_site()->or($site->twitter_site()) ?>">

<meta name="twitter:creator" content="<?= $page->twitter_creator()->or($site->twitter_creator()) ?>">
