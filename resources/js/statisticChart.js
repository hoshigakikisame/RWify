import Chart from 'chart.js/auto';

(async function () {
    const data = [
        { label: 'Lansia', color: '#F0F9D9', count: 10 },
        { label: 'Dewasa', color: '#265073', count: 20 },
        { label: 'Balita', color: '#277F80', count: 15 },
        { label: 'Remaja', color: '#9AD0C2', count: 25 },
        { label: 'Anak-Anak', color: '#A8EEE2', count: 22 },
    ];

    new Chart(document.getElementById('myChart'), {
        type: 'doughnut',
        data: {
            labels: data.map((row) => row.label),
            datasets: [
                {
                    data: data.map((row) => row.count),
                    backgroundColor: data.map((row) => row.color),
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
})();
