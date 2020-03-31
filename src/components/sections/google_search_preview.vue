<template>
  <div>
    <div class="k-field-label">{{ headline }}</div>
    <div class="google-search-preview">
      <div class="google-search-preview__content-container">
        <h2 class="google-search-preview__headline">{{ meta_title }}</h2>
        <span class="google-search-preview__url">{{ meta_url }}</span>
        <p class="google-search-preview__paragraph">
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
      meta_title: "",
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

      return meta_description.length < 1
        ? "[Description Missing]"
        : meta_description;
    },
    meta_keywords() {
      let meta_keywords = this.$store.getters["content/values"]().meta_keywords;

      return meta_keywords.length < 1 ? "[Keywords Missing]" : meta_keywords;
    },
    store_image() {
      return this.$store.getters["content/values"]().meta_image;
    }
  },
  watch: {
    store_image: {
      handler() {
        this.$api.files
          .get(
            this.$store.getters["content/model"]().api,
            this.store_image[0].filename,
            {
              view: "compact"
            }
          )
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
.google-search-preview {
  position: relative;
  width: 100%;
  max-width: 480px;
  background: #fff;
  border: 1px solid #ccc;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  margin-bottom: 0.5em;
}

.google-search-preview__content-container {
  padding: 1em;
}

.google-search-preview__headline {
  margin-top: 0;
  margin-bottom: 0.25em;
  font-size: 1.25em;
  font-weight: normal;
  color: #1a0dab;
}

.google-search-preview__paragraph {
  margin: 0;
  font-size: 0.875em;
  line-height: 1.3em;
  color: #3c4043;
}

.google-search-preview__url {
  display: block;
  margin-bottom: 0.5em;
  font-size: 0.875em;
  color: #006621;
}
</style>
