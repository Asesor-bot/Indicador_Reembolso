<div>
    <div style="width: 70%; margin: 0 auto; padding: 20px;">
        <canvas id="stackedBarChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('stackedBarChart').getContext('2d');
        const stackedBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
                datasets: [
                    {
                        label: 'Dataset 1',
                        data: [10, 20, 30, 40, 50, 60, 70],
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    },
                    {
                        label: 'Dataset 2',
                        data: [15, 25, 35, 45, 55, 65, 75],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Stacked Bar Chart',
                    },
                },
                scales: {
                    x: { stacked: true },
                    y: { stacked: true, beginAtZero: true },
                },
            },
        });
    });
</script>

</div>
