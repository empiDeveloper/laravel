<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5>Estadísticas de ventas por tiendas</h5>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <table class="table table-striped table-sm" style="border-radius: 10px;">
                    <thead>
                        <tr class="colmnas-table">
                            <th scope="col">#</th>
                            <th scope="col">Tienda</th>
                            <th scope="col">Productos vendidos</th>
                            <th scope="col">Total ventas</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(store, index) in stores" :key="index">
                            <th class="text-center" width="5%">{{ index + 1 }}</th>
                            <td>{{ store.name }}</td>
                            <td class="text-center">{{ numberFormat(store.countProducts) }}</td>
                            <td class="text-center">{{ currencyFormat(store.totalSales) }}</td>
                            <td class="text-center">{{ store.state == 1 ? 'Activo' : 'Inactivo' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <Graphics :options="option" />
            </div>
        </div>
    </div>
</template>

<script setup>
// Imports
import { ref, onMounted } from 'vue';
import { currencyFormat, numberFormat } from '../../../../src/util/formats';
import * as Service from '../../services/graphics';
import Graphics from '../graphics';

// Data
const stores = ref([]);
const option = ref({
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            crossStyle: {
                color: '#999'
            }
        }
    },
  legend: {
    data: ['Total ventas', 'Total productos vendidos']
  },
  xAxis: [
    {
        type: 'category',
        data: [],
        axisPointer: {
            type: 'shadow'
        },
        axisLabel: {
            rotate: 30
        },
    }
  ],
  yAxis: [
    {
      type: 'value',
      name: 'Total ventas',
    },
    {
      type: 'value',
      name: 'Total productos vendidos',
    }
  ],
  series: [
    {
      name: 'Total ventas',
      type: 'bar',
      tooltip: {
        valueFormatter: function (value) {
          return currencyFormat(value);
        }
      },
      data: []
    },
    {
      name: 'Total productos vendidos',
      type: 'line',
      yAxisIndex: 1,
      tooltip: {
        valueFormatter: function (value) {
          return numberFormat(value);
        }
      },
      data: []
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
        const { data } = await Service.getGraphicStores();
        if (data.data) {
            stores.value = data.data;
            mountGraph(data.data);
        }
    } catch(error){
        console.error(error);
    }
}

async function mountGraph(data) {
    if (data.length < 1) return;

    const names = data.map((el) => { return el.name });
    const sales = data.map((el) => { return el.totalSales });
    const products = data.map((el) => { return el.countProducts });

    option.value.xAxis[0].data = names;
    option.value.series[0].data = sales;
    option.value.series[1].data = products;
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
