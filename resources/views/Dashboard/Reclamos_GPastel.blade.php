<div style="width: 400px; margin: auto; ms-1">
                <canvas id="pieChart"></canvas>
                <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const data = {
                        labels: @json($labels),
                        datasets: [{
                            label: '# of Votes',
                            data: @json($data),
                            borderWidth: 1,
                            backgroundColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0',
                                '#D35400'
                            ],
                        }]
                    };

                    function handleHover(evt, item, legend) {
                        legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                            colors[index] = index === item.index || color.length === 9 ? color : color +
                                '4D';
                        });
                        legend.chart.update();
                    }

                    function handleLeave(evt, item, legend) {
                        legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                            colors[index] = color.length === 9 ? color.slice(0, -2) : color;
                        });
                        legend.chart.update();
                    }

                    const config = {
                        type: 'pie',
                        data: data,
                        options: {
                            plugins: {
                                legend: {
                                    onHover: handleHover,
                                    onLeave: handleLeave
                                }
                            }
                        }
                    };

                    const ctx = document.getElementById('pieChart').getContext('2d');
                    new Chart(ctx, config);
                });
                </script>

            </div>