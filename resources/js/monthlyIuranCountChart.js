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
            categories: keys
        },
        yaxis: {
            labels: {
                formatter: function ($value) {
                    return "Rp." + $value
                }
            }
        }
    }

    let chart = new ApexCharts(document.querySelector(chartSelector), options);

    chart.render();
} 