<template>
    <div class="container py-4 px-3 mx-auto">
        <div class="row">
            <div class="col-4">
                <div class="input-group-sm mb-3">
                    <input v-model="search" type="text" class="form-control" placeholder="Buscar publicación" aria-describedby="button-addon2-sm" @input="searchPublication">
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div v-for="(item, index) in posts" :key="index" class="col-4">
                <div class="card" :class="index > 2 ? 'mt-3' : ''" style="cursor: pointer" @click="goDetailPost(item.id)">
                    <img src="/img/products/8.jpg" width="100" height="200" class="card-img-top">
                    <div class="card-body">
                        <h4 class="card-title">{{ currencyFormat(item.price) }}</h4>
                        <div>
                            <small class="card-text">{{ item.title }}</small>
                        </div>
                        <div class="text-secondary">
                            <p><small class="card-text">{{ item.city }} - {{ item.stateCity }}</small></p>
                        </div>
                        <div class="text-secondary">
                            <p><small class="card-text">{{ dateFormat(item.created_at, 'DD [de] MMM YYYY') }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col" />
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col" />
        </div>
    </div>
  </template>

<script setup>
// imports
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { numberFormat } from '../../../../src/util/formats';
import { dateFormat } from '../../../../src/util/dateFormat';
import { delay } from '../../../../src/util/delay';
import * as Service from '../../services/posts';

// references
const router = useRouter();

// lifecycle
onMounted(() => {
    getData();
});

// data
const loading = ref(false);
const posts = ref([]);
const search = ref('');

// functions
async function getData(){
    try {
        if(loading.value) return;
        loading.value = true;

        const params = {
            query: search.value
        }

        const { data } = await Service.getData(params);
        posts.value = data.data;
    } catch(e) {
        console.error(e);
    } finally {
        loading.value = false;
    }
}

async function searchPublication(){
    if (search.value && search.value.length > 2) {
        const search = (() => {
            getData();
        });
        delay(search, 600);
    }
    if (!search.value) getData();
}

async function goDetailPost(idPost){
    router.push({ name:'posts.detail', params:{ idPost } });
}

</script>
