<template>
  <div>
    <div class="k-field-label">{{ headline }}</div>
    <div class="open-graph-preview">
      <div class="open-graph-preview__image-container">
        <img
          v-if="this.store_image.length"
          :src="og_image"
          class="open-graph-preview__preview-image"
        />
      </div>

      <div class="open-graph-preview__content-container">
        <span class="open-graph-preview__url">{{ og_site_name }}</span>
        <h2 class="open-graph-preview__preview-headline">
          {{ og_title }}
        </h2>
        <p class="open-graph-preview__preview-paragraph">
          {{ og_description }}
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
      url: null,
      og_image: null
    };
  },
  created: function() {
    this.load().then(response => {
      this.headline = response.headline;
      this.url = response.url;
    });
  },
  computed: {
    og_title() {
      let og_title = this.$store.getters["content/values"]().og_title;

      if (og_title.length < 1) {
        og_title = "[OG Title Missing]";
        return og_title;
      } else {
        return og_title;
      }
    },
    og_description() {
      let og_description = this.$store.getters["content/values"]()
        .og_description;

      if (og_description.length < 1) {
        og_description = "[OG Description Missing]";
        return og_description;
      } else {
        return og_description;
      }
    },
    og_site_name() {
      let og_site_name = this.$store.getters["content/values"]().og_site_name;

      if (og_site_name.length < 1) {
        og_site_name = "[OG Site Name Missing]";
        return og_site_name;
      } else {
        return og_site_name;
      }
    },
    store_image() {
      return this.$store.getters["content/values"]().og_image;
    }
  },
  watch: {
    store_image: {
      handler() {
        if (this.store_image.length === 0) {
          this.og_image = null;
        } else {
          this.$api.files
            .get("site", this.store_image[0].filename, { view: "compact" })
            .then(response => {
              this.og_image = response.url;
            });
        }
      },
      immediate: true
    }
  }
};
</script>

<style lang="css">
.open-graph-preview {
  position: relative;
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 438px;
  background: #fff;
  border: 1px solid #ccc;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.open-graph-preview__image-container {
  position: relative;
  width: 100%;
  padding-bottom: 52.25%;
}

.open-graph-preview__image-container:before {
  content: "Image Missing";
  color: #ddd;
  position: absolute;
  font-size: 2em;
  top: 50%;
  left: 50%;
  width: 100%;
  text-align: center;
  transform: translateX(-50%) translateY(-50%);
}

.open-graph-preview__preview-image {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.open-graph-preview__content-container {
  padding: 0.25em 0.75em 0.5em;
  background: #f2f3f5;
  border-top: 1px solid #dddfe2;
}

.open-graph-preview__url {
  font-size: 0.625em;
  text-transform: uppercase;
  color: #5e6771;
}

.open-graph-preview__preview-headline {
  margin: 0 0 0.25em 0;
  padding: 0;
  font-size: 1em;
  color: #1c212a;
}

.open-graph-preview__preview-paragraph {
  margin: 0;
  padding: 0;
  font-size: 0.75em;
  color: #5e6771;
}
</style>
