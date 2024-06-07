import Chart from 'chart.js/auto';

export default function ageChartStatistic(lansia, dewasa, remaja, anak, balita) {
    const data = [
        { label: 'Lansia', color: '#F0F9D9', count: lansia },
        { label: 'Dewasa', color: '#265073', count: dewasa },
        { label: 'Balita', color: '#277F80', count: balita },
        { label: 'Remaja', color: '#9AD0C2', count: remaja },
        { label: 'Anak-Anak', color: '#A8EEE2', count: anak },
    ];

    const plugin = {
        beforeInit(chart) {
            const originalFit = chart.legend.fit;
            chart.legend.fit = function fit() {
                originalFit.bind(chart.legend)();
                this.width += 100;
            }
        }
    }

    new Chart(document.getElementById('myChart'), {

        type: 'doughnut',
        data: {
            labels: data.map((row) => row.label),
            datasets: [
                {
                    data: data.map((row) => row.count),
                    backgroundColor: data.map((row) => row.color),
                    borderColor: data.map((row) => row.color),
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'left',
                    align: 'start',
                    labels: {
                        padding: 20,
                    },
                }
            },
            layout: {
                padding: {
                    left: 50
                }
            },
            color: '#9CA3AF',
        },
        plugins: {
            beforeInit: [plugin]
        }
    });



}