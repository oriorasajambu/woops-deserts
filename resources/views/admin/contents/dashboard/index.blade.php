@extends('admin.index')
@section('heads')
    <title>Dashboard</title>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Yesterday's Order</p>
                            <h4 class="mb-0">{{ $daily_order_chart ? $daily_order_chart[0] :"-" }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">
                            @if ($daily_order_chart && count($daily_order_chart) >= 2)
                                @php
                                    $increasePercentage = (($daily_order_chart[0] - $daily_order_chart[1]) / $daily_order_chart[1] * 100)
                                @endphp
                                <span class="{{ $increasePercentage >= 0 ? 'text-success' : 'text-danger' }} text-sm font-weight-bolder">{{ $increasePercentage >= 0 ? '+' : '' }}{{ number_format($increasePercentage, 1)}}%</span>
                            @else
                                <span class="text-success text-sm font-weight-bolder">+0%</span>
                            @endif
                            than yesterday
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Yesterday's Payment</p>
                            <h4 class="mb-0">@lang('currency.in_ID') {{ $daily_order_payment ? number_format($daily_order_payment[0], 1) :"-" }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">
                            @if ($daily_order_payment && count($daily_order_payment) >= 2   )
                                @php
                                    $increasePercentage = (($daily_order_payment[0] - $daily_order_payment[1]) / $daily_order_payment[1] * 100)
                                @endphp
                                <span class="{{ $increasePercentage >= 0 ? 'text-success' : 'text-danger' }} text-sm font-weight-bolder">{{ $increasePercentage >= 0 ? '+' : '' }}{{ number_format($increasePercentage, 1)}}%</span>
                            @else
                                <span class="text-success text-sm font-weight-bolder">+0%</span>
                            @endif
                            than yesterday
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Today's Finished Order</p>
                            <h4 class="mb-0">{{ $sum_paid_order_total ? $sum_paid_order_total[0] :"-" }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">
                            @if ($sum_paid_order_total && count($sum_paid_order_total) >= 2   )
                                @php
                                    $increasePercentage = (($sum_paid_order_total[0] - $sum_paid_order_total[1]) / $sum_paid_order_total[1] * 100)
                                @endphp
                                <span class="{{ $increasePercentage >= 0 ? 'text-success' : 'text-danger' }} text-sm font-weight-bolder">{{ $increasePercentage >= 0 ? '+' : '' }}{{ number_format($increasePercentage, 1)}}%</span>
                            @else
                                <span class="text-success text-sm font-weight-bolder">+0%</span>
                            @endif
                            than yesterday</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Today's Paid Order</p>
                            <h4 class="mb-0">@lang('currency.in_ID') {{ $sum_paid_order_per ? number_format($sum_paid_order_per[0], 1) :"-" }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0">
                            @if ($sum_paid_order_per && count($sum_paid_order_per) >= 2   )
                                @php
                                    $increasePercentage = (($sum_paid_order_per[0] - $sum_paid_order_per[1]) / $sum_paid_order_per[1] * 100)
                                @endphp
                                <span class="{{ $increasePercentage >= 0 ? 'text-success' : 'text-danger' }} text-sm font-weight-bolder">{{ $increasePercentage >= 0 ? '+' : '' }}{{ number_format($increasePercentage, 1)}}%</span>
                            @else
                                <span class="text-success text-sm font-weight-bolder">+0%</span>
                            @endif
                            than yesterday</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 col-md-6 mt-4 mb-4">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Daily Order Performance</h6>
                        <p class="text-sm ">Last Order Performance</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-4 mb-4">
                <div class="card z-index-2  ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Monthly Order Performance</h6>
                        <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col mt-4 mb-3">
                <div class="card z-index-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 ">Monthly Paid Order Performance</h6>
                        <p class="text-sm ">Last Paid Performance</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: {!! json_encode(array_reverse($day_cycle)) !!},
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: {{ json_encode(array_reverse($daily_order_chart)) }},
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: {!! json_encode(array_reverse($month_cycle)) !!},
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: {{ json_encode(array_reverse($monthly_order_chart)) }},
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: {!! json_encode(array_reverse($month_cycle)) !!},
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: {{ json_encode(array_reverse($monthly_invoice_chart)) }},
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#f8f9fa',
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Roboto",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endsection
