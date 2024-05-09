import { createRouter, createWebHistory } from 'vue-router';
import ListCountry from '@/Components/ListCountry.vue';
import ListProvince from '@/Components/ListProvince.vue';
import ListDistrict from '@/Components/ListDistrict.vue';
import ListPlace from '@/Components/ListPlace.vue';

const routes = [
    { path: '/countries', component: ListCountry },
    { path: '/provinces', component: ListProvince },
    { path: '/districts', component: ListDistrict },
    { path: '/places', component: ListPlace }
];


const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
