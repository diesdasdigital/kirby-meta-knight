import { kirbyup } from "kirbyup/plugin";

window.panel.plugin("diesdasdigital/kirby-meta-knight", {
  sections: kirbyup.import("./components/sections/*.vue"),
});
