<template>
    <div class="row mt-3">
        <div class="col-3">
            <div class="card bg-gray" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title">Ventas del mes</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ currencyFormat(statistics.month) }}</h6>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card bg-gray" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title">Objetivo del mes</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ currencyFormat(statistics.objetive) }}</h6>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card bg-gray" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title">Ventas del último mes</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ currencyFormat(statistics.lastMonth) }}</h6>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card bg-gray" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title">Ventas del año</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ currencyFormat(statistics.year) }}</h6>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
// Imports
import { ref, onMounted } from 'vue';
import { currencyFormat } from '../../../../src/util/formats';
import * as Service from '../../services/cards';

// Data
const statistics = ref({
    month: 0,
    objetive: 0,
    lastMonth: 0,
    year: 0,
});

// Lifecycle
onMounted(() => {
    getData();
});

// Functions
async function getData() {
    try {
        const { data } = await Service.getDataCards();
        if (data.data) statistics.value = data.data;
    } catch (error) {
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
