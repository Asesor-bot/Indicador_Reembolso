<div style="width: 80%; margin: auto;">
                
                <canvas id="lineChart"></canvas>
                
                <div id="legend-container" style="margin-top: 20px;"></div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', () => {
                
                const getOrCreateLegendList = (chart, id) => {
                    const legendContainer = document.getElementById(id);
                    let listContainer = legendContainer.querySelector('ul');

                    if (!listContainer) {
                        listContainer = document.createElement('ul');
                        listContainer.style.display = 'flex';
                        listContainer.style.flexDirection = 'row';
                        listContainer.style.margin = 0;
                        listContainer.style.padding = 0;

                        legendContainer.appendChild(listContainer);
                    }

                    return listContainer;
                };

                const htmlLegendPlugin = {
                    id: 'htmlLegend',
                    afterUpdate(chart, args, options) {
                        const ul = getOrCreateLegendList(chart, options.containerID);

                        while (ul.firstChild) {
                            ul.firstChild.remove();
                        }

                        const items = chart.options.plugins.legend.labels.generateLabels(chart);
                        items.forEach(item => {
                            const li = document.createElement('li');
                            li.style.alignItems = 'center';
                            li.style.cursor = 'pointer';
                            li.style.display = 'flex';
                            li.style.marginLeft = '10px';

                            li.onclick = () => {
                                const {
                                    type
                                } = chart.config;
                                if (type === 'line') {
                                    chart.setDatasetVisibility(item.datasetIndex, !chart
                                        .isDatasetVisible(item.datasetIndex));
                                }
                                chart.update();
                            };

                            const boxSpan = document.createElement('span');
                            boxSpan.style.background = item.fillStyle;
                            boxSpan.style.borderColor = item.strokeStyle;
                            boxSpan.style.borderWidth = item.lineWidth + 'px';
                            boxSpan.style.display = 'inline-block';
                            boxSpan.style.height = '20px';
                            boxSpan.style.marginRight = '10px';
                            boxSpan.style.width = '20px';

                            const textContainer = document.createElement('p');
                            textContainer.style.margin = 0;
                            textContainer.style.padding = 0;
                            textContainer.style.textDecoration = item.hidden ? 'line-through' : '';

                            const text = document.createTextNode(item.text);
                            textContainer.appendChild(text);

                            li.appendChild(boxSpan);
                            li.appendChild(textContainer);
                            ul.appendChild(li);
                        });
                    }
                };

                // Datos del gráfico
                const data = {
                    labels: @json($labels2),
                    datasets: [{
                            label: 'Claims Received',
                            data: @json($dataset1),
                            borderColor: '#FF6384',
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        },
                        {
                            label: 'Claims Resolved',
                            data: @json($dataset2),
                            borderColor: '#36A2EB',
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        },
                    ],
                };

                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        plugins: {
                            htmlLegend: {
                                containerID: 'legend-container',
                            },
                            legend: {
                                display: false,
                            },
                        },
                    },
                    plugins: [htmlLegendPlugin],
                };

                const ctx = document.getElementById('lineChart').getContext('2d');
                new Chart(ctx, config);
            });
            </script>