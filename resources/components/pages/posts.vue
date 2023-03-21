<template>
    <div class="container py-4 px-3 mx-auto">
        <div class="row">
            <div v-for="(data, index) in 5" :key="index" class="col-4">
                <div class="card" :class="index > 2 ? 'mt-3' : ''">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Preguntar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>

<script setup>

</script>
