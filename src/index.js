import View from "./components/View.vue";

panel.plugin("diesdasdigital/kirby-seo", {
  views: {
    example: {
      component: View,
      icon: "preview",
      label: "Example"
    }
  }
});
