<template>
  <div>
    <div class="k-field-label">{{ headline }}</div>
    <div class="google-preview">
      <div class="google-preview__content-container">
        <h2 class="google-preview__headline">{{ meta_title }}</h2>
        <span class="google-preview__url">{{ meta_url }}</span>
        <p class="google-preview__paragraph">
          {{ meta_description }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      headline: "Basic Meta Information",
      meta_title: null,
      url: null,
      meta_image: null
    };
  },
  created: function() {
    this.load().then(response => {
      this.headline = response.headline;
      this.meta_title = response.title.value;
      this.meta_url = response.url;
    });
  },
  computed: {
    meta_description() {
      let meta_description = this.$store.getters["content/values"]()
        .meta_description;

      if (meta_description.length < 1) {
        meta_description = "[Description Missing]";
        return meta_description;
      } else {
        return meta_description;
      }
    },
    store_image() {
      return this.$store.getters["content/values"]().meta_image[0].filename;
    }
  },
  watch: {
    store_image: {
      handler() {
        this.$api.files
          .get("site", this.store_image, { view: "compact" })
          .then(response => {
            this.meta_image = response.url;
          });
      },
      immediate: true
    }
  }
};
</script>

<style lang="css">
.google-preview {
  position: sticky;
  top: 1em;
  width: 100%;
  max-width: 480px;
  background: #fff;
  border: 1px solid #ccc;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.google-preview__content-container {
  padding: 1em;
}

.google-preview__headline {
  margin-top: 0;
  margin-bottom: 0.25em;
  font-size: 1.25em;
  font-weight: normal;
  color: #1a0dab;
}

.google-preview__paragraph {
  margin: 0;
  font-size: 0.875em;
  line-height: 1.3em;
  color: #3c4043;
}

.google-preview__url {
  display: block;
  margin-bottom: 0.5em;
  font-size: 0.875em;
  color: #006621;
}
</style>
