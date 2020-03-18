<script>
import { Line } from 'vue-chartjs';

export default {
    extends: Line,
    props: {
        labels: Array,
        data: Array,
    },
    watch: {
        data: function(newVal, oldVal) { // watch it
            this.chartdata.labels = this.labels;
            this.chartdata.datasets[0].data = this.data;

            this.renderChart(this.chartdata, this.options);
        }
    },
    data() {
        return {
            chartdata: {
                labels: this.labels,
                datasets: [
                    {
                        label: 'Clicks for past 30 days',
                        borderColor: '#42b983',
                        backgroundColor: 'rgba(66, 185, 131, 0.7)',
                        data: this.data,
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            },
        };
    },
    mounted () {
        this.renderChart(this.chartdata, this.options);
    }
}
</script>
