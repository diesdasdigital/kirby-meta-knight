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
            twitter_headline: {
              label: 'Twitter',
              type: 'headline',
              numbered: false
            },
            twitter_title: {
              label: 'Twitter Title',
              type: 'text',
              limit: '70'
            },
            twitter_description: {
              label: 'Twitter Description',
              type: 'text',
              limit: '300'
            },
            twitter_image: {
              label: 'Twitter Image (1200x675)',
              help: 'Will be cropped automatically.',
              type: 'files',
              multiple: 'false',
              max: 1
            },
            twitter_site: {
              label: '@username of website',
              type: 'text',
              width: '1/2'
            },
            twitter_creator: {
              label: '@username of content creator',
              type: 'text',
              width: '1/2'
            }
          }"
        />
      </k-column>
      <k-column width="1/3">
        <k-form
          :fields="{
            twitter_preview_headline: {
              label: 'Twitter Card Preview',
              type: 'headline',
              numbered: false
            }
          }"
        />
        <div class="twitter-cards">
          <div class="twitter-card twitter-card--horizontal">
            <div class="twitter-card__image">
              <img
                src="https://www.kicommunity.de/media/pages/global-assets/3386320672-1580902020/og-image.jpg"
                class="twitter-card__preview-image"
              />
            </div>

            <div class="twitter-card__content-container">
              <h2 class="twitter-card__preview-headline">KI Community</h2>
              <p class="twitter-card__preview-paragraph">
                Wir vernetzen Interessierte, Anwender und Experten zum Thema
                „Künstliche Intelligenz“.
              </p>
              <span class="twitter-card__url">kicommunity.de</span>
            </div>
          </div>

          <div class="twitter-card">
            <div class="twitter-card__image">
              <img
                src="https://www.kicommunity.de/media/pages/global-assets/3386320672-1580902020/og-image.jpg"
                class="twitter-card__preview-image"
              />
            </div>

            <div class="twitter-card__content-container">
              <h2 class="twitter-card__preview-headline">KI Community</h2>
              <p class="twitter-card__preview-paragraph">
                Wir vernetzen Interessierte, Anwender und Experten zum Thema
                „Künstliche Intelligenz“.
              </p>
              <span class="twitter-card__url">kicommunity.de</span>
            </div>
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
.twitter-cards {
  position: sticky;
  top: 1em;
  margin-top: 2em;
}
.twitter-card {
  display: flex;
  width: 100%;
  margin-bottom: 1em;
  max-width: 438px;
  background: #fff;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  line-height: 1.3em;
  border: 1px solid #ccc;
  border-radius: 0.85714em;
  overflow: hidden;
}

.twitter-card--horizontal {
  flex-direction: column;
  max-width: 507px;
}

.twitter-card--horizontal .twitter-card__image {
  width: 100%;
  padding-bottom: 52.25%;
  border-bottom: 1px solid #e1e8ed;
  border-right: none;
}

.twitter-card__image {
  position: relative;
  width: 48%;
  border-right: 1px solid #e1e8ed;
}

.twitter-card__preview-image {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.twitter-card__content-container {
  padding: 1em;
}

.twitter-card__preview-headline {
  margin-top: 0;
  margin-bottom: 0.33em;
  font-size: 1em;
}

.twitter-card__preview-paragraph {
  margin: 0;
  font-size: 0.875em;
}

.twitter-card__url {
  display: block;
  margin-top: 0.33em;
  margin-bottom: 0;
  padding: 0;
  font-size: 0.875em;
  color: #8899a6;
}
</style>
