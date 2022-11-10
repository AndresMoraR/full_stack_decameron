import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
// import axios
import axios from 'axios'
// define baseURL
axios.defaults.baseURL = 'http://localhost:8080/'
 
createApp(App).use(router).mount('#app')