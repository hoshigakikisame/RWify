import ApexCharts from 'apexcharts'

export default function monthlyIuranCountChart(chartSelector, keys, values) {

    let options = {
        chart: {
            type: 'area'
        },
        series: [{
            name: 'Jumlah Iuran',
            data: values
        }],
        xaxis: {
            categories: keys,
            labels: {
                style: {
                    colors: '#9CA3AF',
                }
            },
        },
        yaxis: {
            labels: {
                formatter: function ($value) {
                    return "Rp." + $value
                },
                style: {
                    colors: '#9CA3AF',
                }
            },
        },
        colors: ['#00B14F'],
    }

    let chart = new ApexCharts(document.querySelector(chartSelector), options);

    chart.render();
} 