<div class="d-flex {{ $class }}">   
    @if ($type == 'bar')
        <div class="d-flex flex-column border px-4 rounded" style="background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff90)">
            <small class="fw-bold text-secondary">{{ $title }}</small>
            <canvas id="{{ $id }}"></canvas>
        </div> 
        <script>
            (() => {
                const datas = @json($datas);
                new Chart(document.getElementById('{{ $id }}'), {
                    type: 'bar',
                    data: {
                        labels: Object.keys(datas),
                        datasets: [{
                            label: '{{ $label }}',
                            data: Object.values(datas),
                            backgroundColor: 'rgba(75,192,192,0.2)',
                            borderColor: 'rgba(75,192,192,1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            })();
        </script>
    @elseif ($type == 'pie')
        <div class="d-flex flex-column border px-4 rounded" style="padding-top: 2em; background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff90)">
            <small class="fw-bold text-secondary" style="margin-bottom: -2em">{{ $title }}</small>
            <canvas id="{{ $id }}" style="font-size: .6em"></canvas>
        </div> 
        <script>
            (() => {
                const datas = @json($datas);
                new Chart(document.getElementById('{{ $id }}'), {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(datas),
                        datasets: [{
                            label: '{{ $label }}',
                            data: Object.values(datas),
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                                align: 'center',
                                labels: { 
                                    usePointStyle: true,
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                });
            })();
        </script>
    @elseif ($type == 'count')
        <div class="d-flex flex-column justify-content-center gap-1 border p-4 rounded w-100" style="height: 106px; background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff90)">
            <small class="fw-bold text-secondary">{{ $title }}</small>
            <h4 >{{ $datas }}</h4>
        </div> 
    @endif
</div>