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
            og_headline: {
              label: 'Open Graph (Facebook)',
              type: 'headline',
              numbered: false
            },
            og_title: {
              label: 'OG Title',
              type: 'text'
            },
            og_description: {
              label: 'OG Description',
              type: 'textarea'
            },
            og_image: {
              label: 'OG Image',
              required: true,
              type: 'files'
            },
            og_site_name: {
              label: 'OG Site Name',
              help:
                'If your object is part of a larger web site, the name which should be displayed for the overall site.',
              type: 'text',
              width: '1/2'
            },
            og_url: {
              label: 'OG URL',
              help:
                'The canonical URL of your object that will be used as its permanent ID in the graph.',
              type: 'url',
              width: '1/2'
            },
            og_audio: {
              label: 'OG Audio',
              help: 'A URL to an audio file to accompany this object.',
              type: 'url',
              width: '1/2'
            },
            og_video: {
              label: 'OG Video',
              help: 'A URL to a video file that complements this object.',
              type: 'url',
              width: '1/2'
            },
            og_determiner: {
              label: 'OG Determiner',
              help:
                'The word that appears before this object\'s title in a sentence.',
              type: 'text',
              width: '1/2'
            },
            og_locale: {
              label: 'OG Locale',
              help: 'The locale these tags are marked up in',
              type: 'text',
              width: '1/2'
            },
            og_locale_alternate: {
              label: 'OG Locale Alternate',
              help: 'An array of other locales this page is available in.',
              type: 'text',
              width: '1/2'
            },
            og_type: {
              label: 'OG Type',
              help:
                'The type of your object, e.g., video.movie. Depending on the type you specify, other properties may also be required.',
              type: 'select',
              default: 'website',
              options: [
                { value: 'website', text: 'Website' },
                { value: 'article', text: 'Article' },
                { value: 'book', text: 'Book' },
                { value: 'profile', text: 'Profile' },
                { value: 'movie', text: 'Movie' },
                { value: 'episode', text: 'Episode' }
              ],
              width: '1/1'
            },
            og_type_no_additional_fields: {
              label: 'No Additional Fields for this type',
              type: 'info',
              when: {
                og_type: 'website'
              }
            },
            og_type_article_published_time: {
              label: 'OG Article Published Time',
              type: 'date',
              time: true,
              default: now,
              width: '1/3',
              when: {
                og_type: 'article'
              }
            },
            og_type_article_modified_time: {
              label: 'OG Article Modified Time',
              type: 'date',
              time: true,
              default: now,
              width: '1/3',
              when: {
                og_type: 'article'
              }
            },
            og_type_article_expiration_time: {
              label: 'OG Article Expiration Time',
              type: 'date',
              time: true,
              default: now,
              width: '1/3',
              when: {
                og_type: 'article'
              }
            }
          }"
        />
      </k-column>
      <k-column width="1/3">
        <k-form
          :fields="{
            facebook_preview_headline: {
              label: 'Facebook Sharing Preview',
              type: 'headline',
              numbered: false
            }
          }"
        />
        <div class="og-preview">
          <div class="og-preview__image-container">
            <img
              src="https://www.kicommunity.de/media/pages/global-assets/3386320672-1580902020/og-image.jpg"
              class="og-preview__preview-image"
            />
          </div>

          <div class="og-preview__content-container">
            <span class="og-preview__url">kicommunity.de</span>
            <h2 class="og-preview__preview-headline">
              {{ og.og_title || Missing }}
            </h2>
            <p class="og-preview__preview-paragraph">
              {{ og.og_description || Missing }}
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
.og-preview {
  position: sticky;
  position: -webkit-sticky; /* Safari */
  top: 1em;
  display: flex;
  flex-direction: column;
  width: 100%;
  margin-top: 2em;
  margin-bottom: 1em;
  max-width: 438px;
  background: #fff;
  border: 1px solid #ccc;
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
