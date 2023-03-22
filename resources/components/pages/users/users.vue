<template>
    <div class="container py-4 px-3 mx-auto">
        <table class="table table-hover table-style">
            <thead>
                <tr class="text-center">
                    <th width="5%">#</th>
                    <th width="5%"></th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>País</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <th class="text-center">{{ user.id }}</th>
                    <td class="text-center">
                        <img :src="user.image" class="img-user" />
                    </td>
                    <td>{{ user.name }}</td>
                    <td class="text-center">{{ user.state }}</td>
                    <td class="text-center">{{ user.countrie }}</td>
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
import * as Service from '../../services/index.js';

// data
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
    try {
        if(loading.value) return;
        loading.value = true;

        const params = {
            page: page.value,
            skip: users.value.length,
            limit: limit.value
        };

        const { data } = await Service.getData(params);
        users.value = users.value.concat(data.data);
    } catch(e) {
        console.error(e);
    } finally {
        loading.value = false;
    }
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

.img-user {
    width: 40px;
    height: 40px;
    border-radius: 50px;
    box-shadow: 2px 2px 2px 1px #838282;
}
</style>
