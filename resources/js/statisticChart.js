import Chart from 'chart.js/auto';

export default async function ageChartStatistic(lansia, dewasa, remaja, anak, balita) {
    const data = [
        { label: 'Lansia', color: '#F0F9D9', count: lansia },
        { label: 'Dewasa', color: '#265073', count: dewasa },
        { label: 'Balita', color: '#277F80', count: balita },
        { label: 'Remaja', color: '#9AD0C2', count: remaja },
        { label: 'Anak-Anak', color: '#A8EEE2', count: anak },
    ];

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
            plugins: {
                datalabels: {
                    labels: {
                        formatter: (value) => {
                            return value + '%';
                        },
                    },
                },
                legend: {
                    display: false,
                },
            },
        },
    });
};
