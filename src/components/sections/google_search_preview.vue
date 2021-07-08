<template>
  <div>
    <div class="k-field-label">
      <span class="google-icon"></span> {{ headline }}
    </div>
    <div class="google-search-preview">
      <div class="google-search-preview__content-container">
        <h2 class="google-search-preview__headline">
          {{ meta_title }}
        </h2>
        <span class="google-search-preview__url">{{ meta_url }}</span>
        <p class="google-search-preview__paragraph">
          {{ meta_description }}
        </p>
      </div>
    </div>
    <div
      v-if="siteTitleAsHomePageTitle && uid == 'home'"
      class="k-text k-field-help"
      data-theme="help"
    >
      <p>Using the site title as home page title.</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      headline: null,
      site_title: null,
      this_page_title: null,
      url: null,
      meta_image: null,
    };
  },
  created: function() {
    this.load().then((response) => {
      this.headline = response.headline;
      this.page_title = response.title.value;
      this.meta_url = response.url;
      this.uid = response.uid;
      this.siteTitleAfterPageTitle = response.siteTitleAfterPageTitle;
      this.siteTitleAsHomePageTitle = response.siteTitleAsHomePageTitle;
      this.separator = response.separator;
    });
    this.$api.site.get().then((response) => {
      this.site_title = response.title;
      this.site_meta_title = response.content.meta_title;
    });
  },
  computed: {
    meta_title() {
      let meta_title = this.$store.getters["content/values"]().meta_title;
      if (this.site_title == this.page_title) {
        if (meta_title == "") {
          meta_title = this.site_title;
        }
      } else if (this.uid == "home" && this.siteTitleAsHomePageTitle) {
        meta_title = this.site_meta_title || this.site_title;
      } else {
        if (this.siteTitleAfterPageTitle == true) {
          if (meta_title == "") {
            meta_title = this.page_title + this.separator + this.site_title;
          } else {
            meta_title = meta_title + this.separator + this.site_title;
          }
        } else {
          if (meta_title == "") {
            meta_title = this.site_title + this.separator + this.page_title;
          } else {
            meta_title = this.site_title + this.separator + meta_title;
          }
        }
      }
      return meta_title;
    },
    meta_description() {
      let meta_description = this.$store.getters["content/values"]()
        .meta_description;

      return meta_description.length < 1
        ? "[Description Missing]"
        : meta_description;
    },
    store_image() {
      return this.$store.getters["content/values"]().meta_image;
    },
  },
  watch: {
    store_image: {
      handler() {
        if (this.store_image.length === 0) {
          this.meta_image = null;
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
              this.meta_image = response.url;
            });
        }
      },
      immediate: true,
    },
  },
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

.google-icon {
  display: inline-block;
  width: 1.25em;
  height: 1.25em;
  transform: translateY(0.25em);
  line-height: 2;
  background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTI4IiBoZWlnaHQ9IjEyOCIgdmlld0JveD0iMCAwIDEyOCAxMjgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik0xMTkuNDg3IDQxLjA3NjNDMTIyLjUwMiA0OC4zNDkgMTI0IDU2LjAwNTUgMTI0IDY0LjAwOTFDMTI0IDcyLjAxMjggMTIyLjQ4MyA3OS42NjkzIDExOS40ODcgODYuOTQyQzExNi40NzEgOTQuMjE0NyAxMTIuMTIyIDEwMC43MiAxMDYuNDIxIDEwNi40MjFDMTAwLjcyIDExMi4xMjIgOTQuMjMzIDExNi40OSA4Ni45NDIgMTE5LjQ4N0M3OS42NTEgMTIyLjUwMiA3Mi4wMTI4IDEyNCA2NC4wMDkxIDEyNEM1Ni4wMDU1IDEyNCA0OC4zNDkgMTIyLjQ4MyA0MS4wNzYzIDExOS40ODdDMzMuODAzNiAxMTYuNDcxIDI3LjI5ODMgMTEyLjEyMiAyMS41OTcxIDEwNi40MjFDMTUuODk1OCAxMDAuNzIgMTEuNTI4NiA5NC4yMzMgOC41MTM0OCA4Ni45NDJDNS41MTY2NyA3OS42NjkzIDQgNzIuMDEyOCA0IDY0LjAwOTFDNCA1Ni4wMDU1IDUuNDk4NCA0OC4zNDkgOC41MTM0OCA0MS4wNzYzQzExLjUyODYgMzMuODAzNiAxNS44Nzc2IDI3LjI5ODMgMjEuNTk3MSAyMS41OTcxQzI3LjMxNjYgMTUuODk1OCAzMy43ODUzIDExLjUyODYgNDEuMDc2MyA4LjUxMzQ4QzQ4LjM0OSA1LjQ5ODQgNTYuMDA1NSA0IDY0LjAwOTEgNEM3Mi4wMTI4IDQgNzkuNjY5MyA1LjUxNjY3IDg2Ljk0MiA4LjUxMzQ4Qzk0LjIxNDcgMTEuNTI4NiAxMDAuNzIgMTUuODc3NiAxMDYuNDIxIDIxLjU5NzFDMTEyLjEyMiAyNy4yOTgzIDExNi40OSAzMy43ODUzIDExOS40ODcgNDEuMDc2M1pNOTcuMTkzMiA2My41ODg5Qzk3LjE5MzIgNjEuNDg3NCA5Ni45Mzc0IDU5LjM4NiA5Ni40MDc1IDU3LjI4NDZINjQuNzQwMVY3MC40NTk2SDgyLjk0MDJDODEuOTcxNyA3NC45NTQ4IDc5LjY2OTMgNzguMzE3IDc2LjAxNDYgODAuNTgyOUM3Mi44MTY4IDgyLjY0NzggNjkuMDUyNSA4My42NzExIDY0LjcyMTggODMuNjcxMUM1NS43NDk3IDgzLjY3MTEgNDkuMzkwNiA3OS4wODQ1IDQ1LjY2MjkgNjkuODkzMVY2OS44MzgzSDQ1LjYwOEM0NC45MTM3IDY3Ljc3MzQgNDQuNTg0NyA2NS42OTAzIDQ0LjU4NDcgNjMuNTg4OUM0NC41ODQ3IDYxLjMyMyA0NC45NTAyIDU5LjE4NSA0NS42ODExIDU3LjE1NjdDNDkuNDA4OSA0Ny45NjUzIDU1Ljc0OTcgNDMuMzc4NyA2NC43NDAxIDQzLjM3ODdDNjkuNTA5NCA0My4zNzg3IDczLjY3NTYgNDQuODk1NCA3Ny4yMzg5IDQ3LjkyODdMODcuMTI0NyAzNy45MTVDODAuODkzNiAzMi4zMjM0IDczLjQzODEgMjkuNTQ1OSA2NC43NDAxIDI5LjU0NTlDNTEuMjcyNyAyOS41NDU5IDQxLjA5NDYgMzUuODUwMiAzNC4yMjM4IDQ4LjQ3NjlDMzEuODg0OSA1My4wODE4IDMwLjY5NzEgNTguMTI1MiAzMC42OTcxIDYzLjU4ODlDMzAuNjk3MSA2OC45MjQ2IDMxLjg2NjYgNzMuOTQ5NyAzNC4yMjM4IDc4LjYyNzdDNDEuMDk0NiA5MS4xOTk2IDUxLjI3MjcgOTcuNTAzOSA2NC43NDAxIDk3LjUwMzlDNzMuMDM2MSA5Ny41MDM5IDgwLjQxODUgOTQuNjg5OCA4Ni44ODcyIDg5LjA2MTdDOTMuNzU3OSA4My4xMjI5IDk3LjE5MzIgNzQuNjI1OSA5Ny4xOTMyIDYzLjU4ODlaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNOTYuNDA3NSA1Ny4yNjYzQzk2LjkzNzQgNTkuMzY3OCA5Ny4xOTMyIDYxLjQ2OTIgOTcuMTkzMiA2My41NzA2Qzk3LjE5MzIgNzQuNjA3NiA5My43NTc5IDgzLjEwNDYgODYuODg3MiA4OS4wNjE3TDc2LjAzMjkgODAuNTY0N0M3OS42NjkyIDc4LjI5ODggODEuOTcxNyA3NC45MTgyIDgyLjk1ODQgNzAuNDQxM0g2NC43NDAxVjU3LjI2NjNIOTYuNDA3NVoiIGZpbGw9IiM0Mjg1RjQiLz4KPHBhdGggZD0iTTg2Ljg4NzIgODkuMDYxN0M4MC40MTg1IDk0LjY4OTggNzMuMDM2MSA5Ny41MDM5IDY0Ljc0MDEgOTcuNTAzOUM1MS4yNzI3IDk3LjUwMzkgNDEuMDk0NiA5MS4yMTc5IDM0LjIyMzggNzguNjI3N0w0NS42OTk0IDY5Ljg5MzFDNDkuNDI3MSA3OS4wODQ1IDU1Ljc2NzkgODMuNjcxMSA2NC43NTgzIDgzLjY3MTFDNjkuMDg5MSA4My42NzExIDcyLjg1MzQgODIuNjQ3OCA3Ni4wNTEyIDgwLjU4MjlMODYuODg3MiA4OS4wNjE3WiIgZmlsbD0iIzM0QTg1MyIvPgo8cGF0aCBkPSJNNDUuNjgxMSA2OS44OTMxTDM0LjIyMzggNzguNjI3N0MzMS44ODQ5IDczLjkzMTUgMzAuNjk3MSA2OC45MjQ2IDMwLjY5NzEgNjMuNTg4OUMzMC42OTcxIDU4LjEyNTIgMzEuODY2NiA1My4xMDAxIDM0LjIyMzggNDguNDc2OUw0NS42OTk0IDU3LjE1NjdDNDQuOTY4NSA1OS4xODUgNDQuNjAzIDYxLjMyMyA0NC42MDMgNjMuNTg4OUM0NC42MDMgNjUuNjkwMyA0NC45NTAyIDY3Ljc3MzQgNDUuNjI2MyA2OS44MzgzSDQ1LjY4MTFWNjkuODkzMVY2OS44OTMxWiIgZmlsbD0iI0ZCQkMwNSIvPgo8cGF0aCBkPSJNODcuMTI0NyAzNy45MTVMNzcuMjM4OSA0Ny45Mjg3QzczLjY3NTYgNDQuODk1NCA2OS41MDk0IDQzLjM3ODcgNjQuNzQwMSA0My4zNzg3QzU1Ljc2NzkgNDMuMzc4NyA0OS40MDg5IDQ3Ljk2NTMgNDUuNjgxMSA1Ny4xNTY3TDM0LjIyMzggNDguNDc2OUM0MS4wOTQ2IDM1Ljg1MDIgNTEuMjcyNyAyOS41NDU5IDY0Ljc0MDEgMjkuNTQ1OUM3My40MzgxIDI5LjU0NTkgODAuODkzNSAzMi4zNDE3IDg3LjEyNDcgMzcuOTE1WiIgZmlsbD0iI0VBNDMzNSIvPgo8L3N2Zz4K");
  background-size: 100%;
  background-repeat: no-repeat;
}
</style>
