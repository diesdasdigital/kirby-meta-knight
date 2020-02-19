<template>
  <div>
    <div class="k-field-label">{{ headline }}</div>
    <div class="twitter-cards">
      <template v-if="twitter_card_type === 'summary_large_image'">
        <div class="twitter-card twitter-card--horizontal">
          <div class="twitter-card__image">
            <img
              v-if="this.store_image.length"
              :src="twitter_image"
              class="twitter-card__preview-image"
            />
          </div>

          <div class="twitter-card__content-container">
            <h2 class="twitter-card__preview-headline">{{ twitter_title }}</h2>
            <p class="twitter-card__preview-paragraph">
              {{ twitter_description }}
            </p>
            <span class="twitter-card__url">kicommunity.de</span>
          </div>
        </div>
      </template>
      <template v-else>
        <div class="twitter-card">
          <div class="twitter-card__image">
            <img
              v-if="this.store_image.length"
              :src="twitter_image"
              class="twitter-card__preview-image"
            />
          </div>

          <div class="twitter-card__content-container">
            <h2 class="twitter-card__preview-headline">{{ twitter_title }}</h2>
            <p class="twitter-card__preview-paragraph">
              {{ twitter_description }}
            </p>
            <span class="twitter-card__url">kicommunity.de</span>
          </div>
        </div>
      </template>
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
      twitter_image: null
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
    twitter_card_type() {
      let twitter_card_type = this.$store.getters["content/values"]()
        .twitter_card_type;

      console.log(twitter_card_type);

      return twitter_card_type;
    },
    twitter_title() {
      let twitter_title = this.$store.getters["content/values"]().twitter_title;

      if (twitter_title.length < 1) {
        twitter_title = "[Title Missing]";
        return twitter_title;
      } else {
        return twitter_title;
      }
    },
    twitter_description() {
      let twitter_description = this.$store.getters["content/values"]()
        .twitter_description;

      if (twitter_description.length < 1) {
        twitter_description = "[Description Missing]";
        return twitter_description;
      } else {
        return twitter_description;
      }
    },
    store_image() {
      return this.$store.getters["content/values"]().twitter_image;
    }
  },
  watch: {
    store_image: {
      handler() {
        if (this.store_image.length === 0) {
          this.twitter_image = null;
        } else {
          this.$api.files
            .get("site", this.store_image[0].filename, { view: "compact" })
            .then(response => {
              this.twitter_image = response.url;
            });
        }
      },
      immediate: true
    }
  }
};
</script>

<style lang="css">
.twitter-cards {
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
  width: 25%;
  padding-bottom: 25%;
  border-right: 1px solid #e1e8ed;
}

.twitter-card__image:before {
  content: "Image Missing";
  color: #ddd;
  position: absolute;
  font-size: 1em;
  top: 50%;
  left: 50%;
  width: 100%;
  text-align: center;
  transform: translateX(-50%) translateY(-50%);
}

.twitter-card--horizontal .twitter-card__image:before {
  font-size: 2em;
}

.twitter-card__preview-image {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.twitter-card__content-container {
  padding: 1em;
  width: 75%;
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
