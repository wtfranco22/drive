import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './routes/index';
import { createPinia } from 'pinia'

createApp(App)
.use(createPinia())
.use(router)
.mount("#app")