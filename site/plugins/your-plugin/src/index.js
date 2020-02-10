import View from "./components/View.vue";

panel.plugin("getkirby/pluginkit", {
  views: {
    example: {
      component: View,
      icon: "preview",
      label: "Example"
    }
  }
});
