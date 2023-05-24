<template>
    <div class="container">
        <Cards />
        <hr />
        <div class="row mt-5">
            <div class="col">
                <h5>Vendedores, Top 10</h5>
            </div>
            <div class="col d-flex">
                <button type="button" class="btn btn-primary btn-sm ml-3" @click="goFilter('sales')">Filtar por más ventas</button>
                <button type="button" class="btn btn-primary btn-sm ml-3" @click="goFilter('products')">Filtrar por más productos vendidos</button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <table class="table table-striped table-sm" style="border-radius: 10px;">
                    <thead>
                        <tr class="colmnas-table">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Productos vendidos</th>
                            <th scope="col">Total ventas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(seller, index) in sellers" :key="index">
                            <th class="text-center" width="5%">{{ index + 1 }}</th>
                            <td>
                                <img :src="seller.image" class="image-user" />
                                {{ seller.name }}
                            </td>
                            <td class="text-center" width="15%">{{ numberFormat(seller.countProducts) }}</td>
                            <td class="text-center" width="15%">{{ currencyFormat(seller.countSales) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script setup>
// imports
import { ref, onMounted } from 'vue';
import { currencyFormat, numberFormat } from '../../../../src/util/formats';
import * as Service from '../../services/sellers';
import Cards from './cards.vue';

// Data
const sellers = ref([]);
const filter = ref('sales');

// Lifecycle
onMounted(() => {
    getData();
});

// Functions
async function getData(){
    try {
        const params = { filter: filter.value };
        const { data } = await Service.getSellers(params);
        if (data.data) sellers.value = data.data;
    } catch(error){
        console.error(error);
    }
}

async function goFilter(option) {
    filter.value = option;
    getData();
}
</script>
<style>
.bg-gray {
    background-color: #F8F8F8 !important;
}

.colmnas-table {
    background-color: #FFD906;
    text-align: center;
}

.image-user {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover
}
</style>
