<template>
  <div>
    <div class="k-field-label">
      <span class="facebook-icon"></span> {{ headline }}
    </div>
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
      site_title: null,
      page_title: null,
      url: null,
      og_image: null,
    };
  },
  created: function() {
    this.load().then((response) => {
      this.headline = response.headline;
      this.page_title = response.title.value;
      this.url = response.url;
    });
    this.$api.site.get().then((response) => {
      this.site_title = response.title;
    });
  },
  computed: {
    og_title() {
      let og_title = this.$store.getters["content/values"]().og_title;
      let meta_title = this.$store.getters["content/values"]().meta_title;
      let page_title = this.page_title;

      if (og_title.length < 1) {
        if (meta_title.length > 0) {
          og_title = meta_title;
        } else {
          og_title = page_title;
        }
      }

      return og_title;
    },
    og_description() {
      let og_description = this.$store.getters["content/values"]()
        .og_description;
      let meta_description = this.$store.getters["content/values"]()
        .meta_description;

      if (og_description.length < 1) {
        og_description = meta_description;
        if (meta_description.length < 1) {
          og_description = "[OG Description and Fallback Description Missing]";
        }
      }

      return og_description;
    },
    og_site_name() {
      let og_site_name = this.$store.getters["content/values"]().og_site_name;

      if (og_site_name.length < 1) {
        og_site_name = this.site_title;
        return og_site_name;
      } else {
        return og_site_name;
      }
    },
    store_image() {
      return this.$store.getters["content/values"]().og_image;
    },
  },
  watch: {
    store_image: {
      handler() {
        if (this.store_image.length === 0) {
          this.og_image = this.site_og_image_url;
        } else {
          this.$api.files
            .get(
              this.$store.getters["content/model"]().api,
              this.store_image[0].filename,
              {
                view: "compact",
              }
            )
            .then((response) => {
              this.og_image = response.url;
            });
        }
      },
      immediate: true,
    },
  },
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

.facebook-icon {
  display: inline-block;
  width: 1.25em;
  height: 1.25em;
  transform: translateY(0.25em);
  line-height: 2;
  background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTI4IiBoZWlnaHQ9IjEyOCIgdmlld0JveD0iMCAwIDEyOCAxMjgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xMjQgNjRDMTI0IDMwLjg2NTQgOTcuMTM0NiA0IDY0IDRDMzAuODY1NCA0IDQgMzAuODY1NCA0IDY0QzQgOTMuOTQ1MSAyNS45Mzc4IDExOC43NjkgNTQuNjI1OCAxMjMuMjc0VjgxLjM0NzhIMzkuMzg3NFY2NEg1NC42MjU4VjUwLjc3ODJDNTQuNjI1OCAzNS43NDI0IDYzLjU4NjYgMjcuNDMxMyA3Ny4yODkzIDI3LjQzMTNDODMuODUzNyAyNy40MzEzIDkwLjcyMiAyOC42MDQxIDkwLjcyMiAyOC42MDQxVjQzLjM3SDgzLjE1MzRDNzUuNzAzIDQzLjM3IDczLjM3NDIgNDcuOTkzOCA3My4zNzQyIDUyLjc0NDJWNjRIOTAuMDEzMkw4Ny4zNTU0IDgxLjM0NzhINzMuMzc0MlYxMjMuMjc0QzEwMi4wNjIgMTE4Ljc3NyAxMjQgOTMuOTUzNiAxMjQgNjRaIiBmaWxsPSIjMTk3N0YzIi8+CjxwYXRoIGQ9Ik04Ny4zNTUzIDgxLjM0NzhMOTAuMDEzMiA2NEg3My4zNzQyVjUyLjc0NDJDNzMuMzc0MiA0OC4wMDIzIDc1LjY5NDUgNDMuMzcgODMuMTUzNCA0My4zN0g5MC43MjJWMjguNjA0MUM5MC43MjIgMjguNjA0MSA4My44NTM3IDI3LjQzMTMgNzcuMjg5MyAyNy40MzEzQzYzLjU4NjUgMjcuNDMxMyA1NC42MjU4IDM1LjczMzkgNTQuNjI1OCA1MC43NzgyVjY0SDM5LjM4NzRWODEuMzQ3OEg1NC42MjU4VjEyMy4yNzRDNTcuNjgwMiAxMjMuNzU1IDYwLjgxMDYgMTI0IDY0IDEyNEM2Ny4xODk0IDEyNCA3MC4zMTk4IDEyMy43NDcgNzMuMzc0MiAxMjMuMjc0VjgxLjM0NzhIODcuMzU1M1oiIGZpbGw9IiNGRUZFRkUiLz4KPC9zdmc+Cg==");
  background-size: 100%;
  background-repeat: no-repeat;
}
</style>
