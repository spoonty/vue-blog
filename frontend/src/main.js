import { createApp } from 'vue'
import App from './App.vue'
import {library} from "@fortawesome/fontawesome-svg-core"
import { fas } from '@fortawesome/free-solid-svg-icons'
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const app = createApp(App)

library.add(fas);

app
    .component('fa', FontAwesomeIcon)
    .mount('#app')
