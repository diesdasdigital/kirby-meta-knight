<template>
  <div>
    <k-header>{{ headline }}</k-header>
    <k-grid gutter="large">
      <k-column width="2/3">
        <k-form
          v-model="og"
          @input="input"
          @submit="submit"
          :fields="{
            meta_headline: {
              label: 'Basic Meta Information',
              type: 'headline',
              numbered: false
            },
            meta_description: {
              label: 'Description',
              type: 'text'
            },
            meta_keywords: {
              label: 'Keywords',
              type: 'tags'
            },
            meta_author: {
              label: 'Author\/s',
              type: 'text'
            },
            meta_image: {
              label: 'Image',
              type: 'files',
              multiple: false
            },
            meta_phone_number: {
              label: 'Phone Number',
              type: 'text'
            }
          }"
        />
      </k-column>
      <k-column width="1/3">
        <k-form
          :fields="{
            google_preview_headline: {
              label: 'Google Search Result Preview',
              type: 'headline',
              numbered: false
            }
          }"
        />
        <div class="google-preview">
          <div class="google-preview__content-container">
            <span class="google-preview__url">kicommunity.de</span>
            <h2 class="google-preview__headline">KI Community</h2>
            <p class="google-preview__paragraph">
              Wir vernetzen Interessierte, Anwender und Experten zum Thema
              „Künstliche Intelligenz“.
            </p>
          </div>
        </div>
      </k-column>
    </k-grid>
  </div>
</template>

<script>
export default {
  props: {
    label: "Test",
    endpoints: []
  },
  data() {
    return {
      headline: "",
      og: {
        og_title: null,
        og_description: null,
        og_image: [],
        og_site_name: null,
        og_url: null,
        og_audio: null,
        og_video: null,
        og_determiner: null,
        og_locale: null,
        og_locale_alternate: null,
        og_type: null,
        og_type_no_additional_fields: null,
        og_type_article_published_time: null,
        og_type_article_modified_time: null,
        og_type_article_expiration_time: null
      }
    };
  },
  created() {
    this.load().then(response => {
      this.headline = response.headline;
      this.og_title = reponsoe.og_title;
    });
  },
  methods: {
    input() {
      // the data is automatically updated
      console.log(this.og);
    },
    submit() {
      // let's send this thing to the server
      this.$api.post("/my/api", this.contact);
    }
  }
};
</script>

<style lang="css">
.google-preview {
  position: sticky;
  top: 1em;
  margin-top: 1em;
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
  margin-bottom: 0.5em;
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
