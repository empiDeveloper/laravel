<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-3">
                <div class="card bg-gray" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Ventas del mes</h5>
                        <h6 class="card-subtitle mb-2 text-muted">$253.000.000</h6>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-gray" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Objetivo del mes</h5>
                        <h6 class="card-subtitle mb-2 text-muted">61% Completado</h6>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-gray" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Ventas del último mes</h5>
                        <h6 class="card-subtitle mb-2 text-muted">$645.750.000</h6>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-gray" style="width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">Ventas del año</h5>
                        <h6 class="card-subtitle mb-2 text-muted">$2.346.000.000</h6>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row mt-5">
            <div class="col">
                <h5>Estadísticas de tus vendedores</h5>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <table class="table table-striped table-sm" style="border-radius: 10px;">
                    <thead>
                        <tr style="background-color: #FFD906;">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Productos Vendidos</th>
                            <th scope="col">Cantidad vendida</th>
                            <th scope="col">Mejor estrategia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Daniel Oyola</td>
                            <td>467</td>
                            <td>$253.000.000 COP</td>
                            <td>Catalogo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style>
.bg-gray {
    background-color: #F8F8F8 !important;
}
</style>
