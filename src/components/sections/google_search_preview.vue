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
    <div class="hints">
      <ul>
        <li class="hint">
          <div class="hint__icon">
            <div
              v-if="meta_description_too_long"
              class="hint__icon-inner hint__icon-inner--failure"
            >
              !
            </div>
            <div v-else class="hint__icon-inner hint__icon-inner--success">
              ✓
            </div>
          </div>
          <div class="hint__text">
            <template v-if="meta_description_too_long">
              <div class="hint__text-problem">
                Your <u>meta description</u> is too long.
              </div>
              <div class="hint__text-solution">
                It should be less than 160 characters. Currently it is
                {{ meta_description.length }} characters long.
              </div>
            </template>
            <template v-else>
              <div class="hint__text-problem">
                Your <u>meta description</u> has the perfect lenght.
              </div>
            </template>
          </div>
        </li>
        <li class="hint" v-if="!page_title_includes_focus_keyword">
          <div class="hint__icon">
            <div class="hint__icon-inner hint__icon-inner--failure">!</div>
          </div>
          <div class="hint__text">
            <template v-if="!page_title_includes_focus_keyword">
              <div class="hint__text-problem">
                Your <u>page title</u> does not contain your focus keyword.
              </div>
              <div class="hint__text-solution">
                Add "{{ meta_keywords[0].value.toUpperCase() }}" to your page
                title.
              </div>
            </template>
            <template v-else>
              <div class="hint__text-problem">
                Your page title includes your focus keyword.
              </div>
            </template>
          </div>
        </li>
        <li class="hint" v-if="!meta_description_includes_focus_keyword">
          <div class="hint__icon">
            <div class="hint__icon-inner hint__icon-inner--failure">!</div>
          </div>
          <div class="hint__text">
            <div class="hint__text-problem">
              Your <u>meta descprition</u> does not contain your focus keyword.
            </div>
            <div class="hint__text-solution">
              Add "{{ meta_keywords[0].value.toUpperCase() }}" to your meta
              description.
            </div>
          </div>
        </li>
        <li class="hint" v-if="meta_keywords_too_few">
          <div class="hint__icon">
            <div class="hint__icon-inner hint__icon-inner--failure">!</div>
          </div>
          <div class="hint__text">
            <div class="hint__text-problem">
              Use at least 5 keywords
            </div>
            <div class="hint__text-solution">
              Add "{{ meta_keywords.lenght }}" to your meta description.
            </div>
          </div>
        </li>
      </ul>
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
    meta_description_too_long() {
      let meta_description = this.$store.getters["content/values"]()
        .meta_description;

      return meta_description.length > 160 ? true : false;
    },
    meta_keywords() {
      let meta_keywords = this.$store.getters["content/values"]().meta_keywords;

      return meta_keywords.length < 1 ? "[Keywords Missing]" : meta_keywords;
    },
    page_title_includes_focus_keyword() {
      let meta_title = this.meta_title.toLowerCase();
      let focus_keyword = this.$store.getters[
        "content/values"
      ]().meta_keywords[0].value.toLowerCase();

      return meta_title.includes(focus_keyword) ? true : false;
    },
    meta_description_includes_focus_keyword() {
      let meta_description = this.meta_description.toLowerCase();
      let focus_keyword = this.$store.getters[
        "content/values"
      ]().meta_keywords[0].value.toLowerCase();

      return meta_description.includes(focus_keyword) ? true : false;
    },
    meta_keywords_too_few() {
      let meta_keywords = this.$store.getters["content/values"]().meta_keywords;

      return meta_keywords.length < 5 ? true : false;
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

.hints {
  padding: 0.5em;
}

.hint {
  display: flex;
  align-items: flex-start;
  margin-bottom: 1em;
}

.hint__icon {
  font-size: 0.75em;
}

.hint__icon-inner {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ffc3c3;
  border: 2px solid #ff9e9e;
  border-radius: 50%;
  width: 2em;
  height: 2em;
  margin-right: 0.5em;
  text-align: center;
  font-weight: 600;
}

.hint__icon-inner--success {
  background-color: #f0ffcf;
  border: 2px solid #5d800d;
  color: #5d800d;
}

.hint__icon-inner--failure {
  background-color: #ffc3c3;
  border: 2px solid #c82829;
  color: #c82829;
}

.hint__text {
  width: 80%;
}

.hint__text-problem {
  font-size: 0.875em;
  margin-top: 0.125em;
  margin-bottom: 0.5em;
  font-weight: 600;
}

.hint__text-solution {
  font-size: 0.75em;
  color: #777;
}
</style>
