<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5>Estadísticas de los últimos años</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <Graphics :options="options" />
            </div>
        </div>
    </div>
</template>

<script setup>
// Imports
import { ref, onMounted } from 'vue';
import * as Service from '../../services/graphics';
import Graphics from '../graphics';

// Data
const options = ref({
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    xAxis: {
        type: 'category',
        data: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        axisTick: {
            alignWithLabel: true
        }
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name: "Direct",
            data: [456000, 523780, 679800, 567800, 1050000],
            type: 'bar',
            showBackground: true,
            backgroundStyle: {
                color: 'rgba(180, 180, 180, 0.2)'
            }
        }
    ]
});

// Lifecycle
onMounted(() => {
    getData();
});

// Functions
async function getData(){
    try {
        const { data } = await Service.getGraphicsLastYears();
        if (data.data) console.log(data.data);
    } catch(error){
        console.error(error);
    }
}
</script>

<style>
.text-general {
    color: #020DFD !important;
    font-weight: bold;
    font-family: Nunito;
}

.ml-1 {
    margin-left: 3px;
}

.ml-2 {
    margin-left: 7px;
}

.ml-3 {
    margin-left: 10px;
}

.bg-navbar {
    background-color: #FF8383;
}
</style>
