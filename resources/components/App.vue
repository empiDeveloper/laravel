<template>
    <!-- Menús -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-general">
                <router-link class="nav-link active" to="/">Manager Dev</router-link>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <small>Objetivo mensual:</small><small class="text-general ml-2">$500.000.000 COP</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>Productos vendidos:</small><small class="text-general ml-2">467</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>Mejor vendedor:</small><small class="text-general ml-2">Daniel Oyola</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>Pico más alto:</small><small class="text-general ml-2">13 de mayo, 2023</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>Mejor estrategia:</small><small class="text-general ml-2">Catálogo</small>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Sections -->
    <Statistics />
    <div class="row">
        <div class="col-12">
            <Graphics :options="options" />
        </div>
    </div>
    <router-view />
</template>

<script setup>
// imports
import { ref } from 'vue';
import Statistics from './pages/statistics';
import Graphics from './pages/graphics';

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
