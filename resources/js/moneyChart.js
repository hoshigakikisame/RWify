import ApexCharts from 'apexcharts'

export default function moneyChart(chartSelector) {
    let options = {
        chart: {
            type: 'area'
        },
        series: [{
            name: 'sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
        }
    }

    let chart = new ApexCharts(document.querySelector(chartSelector), options);

    chart.render();
} 