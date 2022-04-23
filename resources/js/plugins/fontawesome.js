import Vue from "vue";
import { library, config } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

// import { } from '@fortawesome/free-regular-svg-icons'

import { fas } from "@fortawesome/free-solid-svg-icons";

import { faGithub } from "@fortawesome/free-brands-svg-icons";

config.autoAddCss = false;

library.add(fas, faGithub);

Vue.component("Fa", FontAwesomeIcon);
