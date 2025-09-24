import './assets/main.css'

import { createApp } from 'vue'
import Toast, { POSITION } from "vue-toastification";
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia';
import './assets/main.css'
import "vue-toastification/dist/index.css"; 
import { Chart as ChartJS, registerables } from 'chart.js';

const app = createApp(App)

// Create Pinia instance
const pinia = createPinia();
app.use(pinia);

// Use the router instance
app.use(router)

// Registrando globalmente todos os componentes do ChartJS usado no vue-chart-3
ChartJS.register(...registerables);

// Toastification options
const options = {
  position: POSITION.TOP_RIGHT,
  timeout: 3000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: false,
  hideProgressBar: false,
  closeButton: "button",
  maxToasts: 5,
  newestOnTop: true,
  icon: true,
  rtl: false,
};
app.use(Toast, options);


app.mount('#app')
