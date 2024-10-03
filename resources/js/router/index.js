import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import Notelist from '../components/Notelist.vue';
import Notes from '../components/Notes.vue'
import EditNote from '../components/EditNote.vue';

const routes = [
  { path: '/', component: Login }, 
  { path: '/Login', component: Login },
  { path: '/Register', component: Register },
  { path: '/Notes', component: Notelist },
  { path: '/Notelist', component: Notes },
  { path: '/notes/:id/edit', component: EditNote, props: true }
];


const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
