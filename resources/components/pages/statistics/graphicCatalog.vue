<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h5>Estadísticas de ventas por estrategía</h5>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <Graphics :options="option" />
            </div>
        </div>
    </div>
</template>

<script setup>
// Imports
import { ref, onMounted } from 'vue';
import { numberFormat } from '../../../../src/util/formats';
import * as Service from '../../services/graphics';
import Graphics from '../graphics';

// Data
const option = ref({
  title: {
    text: 'Destacadas',
    subtext: '',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: 'Estrategía destacada',
      type: 'pie',
      radius: '70%',
      data: [],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
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
        const { data } = await Service.getGraphicCatalog();
        if (data.data) await mountGraph(data.data);
    } catch(error){
        console.error(error);
    }
}

async function mountGraph(data) {
    if (data.length < 1) return;
    const sum = _.sumBy(data, 'value');
    option.value.title.subtext = "Total: "+numberFormat(sum);
    option.value.series[0].data = data;
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
