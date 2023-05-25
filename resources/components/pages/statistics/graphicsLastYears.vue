<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5>Estadísticas de ventas en los últimos años</h5>
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
import { currencyFormat } from '../../../../src/util/formats';
import * as Service from '../../services/graphics';
import Graphics from '../graphics';

// Data
const options = ref({
    title: {
        text: "",
        right: 10
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    xAxis: {
        type: 'category',
        data: [],
        axisTick: {
            alignWithLabel: true
        }
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
            name: "Ventas:",
            data: [],
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
        if (data.data) await mountGraph(data.data);
    } catch(error){
        console.error(error);
    }
}

async function mountGraph(data) {
    if (data.length < 1) return;
    const dataAxis = data.map((el) => { return el.year });
    const dataSeries = data.map((el) => { return el.amount });

    options.value.title.text = "Ventas totales: "+currencyFormat(dataSeries.reduce((a , value) => a + value));
    options.value.xAxis.data = dataAxis;
    options.value.series[0].data = dataSeries;
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
