<template>
    <Bar
        id="my-chart-id"
        :options="chartOptions"
        :data="props.data"
    />
</template>


<script setup>
    import {Bar} from 'vue-chartjs'
    import {Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale} from 'chart.js'
    import {defineProps} from 'vue'

    const props = defineProps({
        data: Array,
        columns: Array,

    });

    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

</script>
