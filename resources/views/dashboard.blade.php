@extends('layouts.app')

@section('content')
    <div>
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-lg-4">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Stolen</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $all_vehicles->count() }}</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->
                        @foreach ($groupedByYearAndMonth as $key => $year)
                            {{-- @dd($key) --}}
                            <!-- Customers Card -->
                            <div class="col">

                                <div class="card info-card customers-card">

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $year->sum() }} total in {{ $key }}</h5>

                                        <div class="">
                                            <div class="">
                                                <table style="width: 100%,">
                                                    <thead>
                                                        <th>Month</th>
                                                        <th>Total</th>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($year as $key => $month)
                                                            {{-- @dd($key) --}}
                                                            <tr>
                                                                <td>

                                                                    <span
                                                                        class="text-danger small pt-1 fw-bold">{{ $key }}</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="text-muted small pt-2 ps-1">{{ $month }}</span>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div><!-- End Customers Card -->
                        @endforeach


                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">2021 VS 2022</h5>

                                    <!-- Line Chart -->
                                    <div id="reportsChart"></div>

                                    <script>
                                        total = @json($groupedByYearAndMonth);
                                        console.log(total);

                                        function formatYearlyTotals(data) {
                                            const result = {};

                                            Object.keys(data).forEach(year => {
                                                // Extract monthly values and initialize with empty strings
                                                const months = new Array(12).fill('');

                                                // Fill the months with actual totals from the data
                                                Object.entries(data[year]).forEach(([month, total]) => {
                                                    const monthIndex = parseInt(month, 10) - 1; // Convert month to zero-based index
                                                    months[monthIndex] = total;
                                                });

                                                result[year] = months;
                                            });

                                            return result;
                                        }


                                        const formattedTotals = formatYearlyTotals(total);
                                        console.log(formattedTotals);


                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                        name: '2022',
                                                        data: formattedTotals['2022'],
                                                    },
                                                    {
                                                        name: '2021',
                                                        data: formattedTotals['2021'],
                                                    },
                                                ],
                                                chart: {
                                                    height: 250,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>

                            </div>
                        </div><!-- End Reports -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">


                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Most</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Vehicle Type</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($vehicle_type->take(10) as $vehicle => $key)
                                            <tr>
                                                <td><b>
                                                        <center>{{ $count++ }}</center>
                                                    </b></td>
                                                <td>{{ $vehicle }}</td>
                                                <td>{{ $key }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div><!-- End Right side columns -->

            </div>
        </section>

    </div><!-- End #main -->
@endsection
