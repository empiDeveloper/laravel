<template>
    <!-- Menú -->
    <nav class="navbar navbar-expand-lg navbarStyle">
        <div class="container-fluid">
            <a class="navbar-brand text-general">
                <router-link class="nav-link active" to="/">Manager Dev</router-link>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ml-2">
                        <small>Productos vendidos:</small><small class="text-general ml-2">{{ numberFormat(statistics.countProducts) }}</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>Total ventas:</small><small class="text-general ml-2">{{ currencyFormat(statistics.soldProducts) }}</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>Stock:</small><small class="text-general ml-2">{{ numberFormat(statistics.countStock) }}</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>Vendedores activos:</small><small class="text-general ml-2">{{ numberFormat(statistics.countSellers) }}</small>
                    </li>
                    <li class="nav-item ml-2">
                        <small>TRM COP:</small><small class="text-general ml-2">{{ currencyFormat(statistics.dollarTRM) }}</small>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Sections -->
    <section>
        <Statistics />
    </section>
    <hr />
    <section>
        <GraphicsLastYears />
    </section>
</template>

<script setup>
// imports
import { ref, onMounted } from 'vue';
import { currencyFormat, numberFormat } from '../../src/util/formats';
import Statistics from './pages/statistics';
import GraphicsLastYears from './pages/statistics/graphicsLastYears.vue';
import * as Service from './services/general';

// Data
const statistics = ref({
    countProducts: 0,
    soldProducts: 0,
    countStock: 0,
    countSellers: 0,
    dollarTRM: 0,
});

// Lifecycle
onMounted(() => {
    getData();
});

// Functions
async function getData(){
    try {
        const { data } = await Service.getGeneralStatistics();
        if (data.data) statistics.value = data.data;
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

.navbarStyle {
    border-bottom: 1px solid #000;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3)
}

</style>
