<template>
  <k-view class="k-test-view">
    <k-header>Example</k-header>
    This is your custom view
    <div class="og-preview">
      <div class="og-preview__image-container">
        <img
          src="https://www.kicommunity.de/media/pages/global-assets/3386320672-1580902020/og-image.jpg"
          class="og-preview__preview-image"
        />
      </div>

      <div class="og-preview__content-container">
        <span class="og-preview__url">kicommunity.de</span>
        <h2 class="og-preview__preview-headline">KI Community</h2>
        <p class="og-preview__preview-paragraph">
          Wir vernetzen Interessierte, Anwender und Experten zum Thema
          „Künstliche Intelligenz“.
        </p>
      </div>
    </div>
  </k-view>
</template>

<script>
export default {
  /** put your view logic here **/
};
</script>

<style lang="css">
.og-preview {
  display: flex;
  flex-direction: column;
  width: 100%;
  margin-bottom: 1em;
  max-width: 438px;
  background: #fff;
  border: 1px solid #dddfe2;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.og-preview__image-container {
  position: relative;
  width: 100%;
  padding-bottom: 52.25%;
}

.og-preview__preview-image {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.og-preview__content-container {
  padding: 0.25em 0.75em 0.5em;
  background: #f2f3f5;
  border-top: 1px solid #dddfe2;
}

.og-preview__url {
  font-size: 0.625em;
  text-transform: uppercase;
  color: #5e6771;
}

.og-preview__preview-headline {
  margin: 0 0 0.25em 0;
  padding: 0;
  font-size: 1em;
  color: #1c212a;
}

.og-preview__preview-paragraph {
  margin: 0;
  padding: 0;
  font-size: 0.75em;
  color: #5e6771;
}
</style>
