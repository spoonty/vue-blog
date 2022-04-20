import { createApp } from 'vue'
import App from './App.vue'
import {library} from "@fortawesome/fontawesome-svg-core"
import { fas } from '@fortawesome/free-solid-svg-icons'
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import router from "./router/router.js";
import store from "./store";

const app = createApp(App)

library.add(fas);

app
    .use(router)
    .use(store)
    .component('fa', FontAwesomeIcon)
    .mount('#app')
