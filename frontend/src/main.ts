import './assets/main.css'

import { createApp } from 'vue'
import Toast, { POSITION } from "vue-toastification";
import App from './App.vue'
import router from './router'
import './assets/main.css'
import "vue-toastification/dist/index.css";

const app = createApp(App)

app.use(router)

app.use(Toast, {
    // Setting the global default position
    position: POSITION.TOP_RIGHT
});

app.mount('#app')
