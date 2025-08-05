import './bootstrap';
import ChatMessage from './components/ChatMessage.vue'
import { createApp } from 'vue/dist/vue.esm-bundler.js';


import SendMessage from './components/SendMessage.vue'





const app=createApp({


	components:{


		SendMessage,
        ChatMessage,


	}


});


app.mount('#app');
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
