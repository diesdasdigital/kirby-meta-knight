import googleSearchPreview from "./components/sections/google_search_preview.vue";
import facebookSharingPreview from "./components/sections/facebook_sharing_preview.vue";
import twitterCardPreview from "./components/sections/twitter_card_preview.vue";

panel.plugin("diesdasdigital/kirby-seo", {
  sections: {
    google_search_preview: googleSearchPreview,
    facebook_sharing_preview: facebookSharingPreview,
    twitter_card_preview: twitterCardPreview
  }
});
