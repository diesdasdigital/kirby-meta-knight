<template>
  <div>
    <basicInformation />
    <openGraph />
    <twitter />
  </div>
</template>

<script>
import basicInformation from "./basic_information.vue";
import openGraph from "./open_graph.vue";
import twitter from "./twitter.vue";

export default {
  components: {
    basicInformation,
    openGraph,
    twitter
  }
};
</script>

<style lang="css"></style>
