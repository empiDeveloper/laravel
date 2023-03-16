<template>
    <div class="container py-4 px-3 mx-auto">
      <h1>Hello, Bootstrap and Webpack is free!</h1>
        <table class="table table-hover table-style">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Nombre completo</th>
                    <th>Edad</th>
                    <th>Genero</th>
                    <th>Pais</th>
                    <th>Comunidad</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <th class="text-center">{{ user.id }}</th>
                    <td>{{ user.name }}</td>
                    <td class="text-center">25</td>
                    <td class="text-center">Masculino</td>
                    <td class="text-center">Colombia</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col" />
            <div class="col-3">
                <button class="btn btn-secondary btn-sm btn-lg ml-auto" @click="seeMore(10)">Ver más 10</button>
                <button class="btn btn-secondary btn-sm btn-lg ml-2" @click="seeMore(100)">Ver más 100</button>
            </div>
        </div>
    </div>
  </template>

<script setup>
// imports
import { ref, onMounted } from 'vue';

// reactive state
const loading = ref(false);
const users = ref([]);
const page = ref(0);
const limit = ref(20);

// lifecycle hooks
onMounted(() => {
  getUsers();
})

// functions
async function getUsers() {
    if(loading.value) return;

    loading.value = true;
    const params = {
        page: page.value,
        skip:  users.value.length,
        limit: limit.value
    };
    axios
    .get('api/users/listar', { params })
    .then(response => {
        users.value = users.value.concat(response.data.result);
        //page.value = response.data.result.current_page;
    })
    .catch(error => {
        console.log(error);
    })
    .finally(() => loading.value = false);
}

async function seeMore(value) {
    limit.value = value;
    page.value = page.value + 1;
    getUsers();
}
</script>

<style>
.style-table {
    background-color: #F5EEF8;
}
</style>
