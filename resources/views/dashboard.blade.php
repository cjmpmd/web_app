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

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33"
                                                fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                                                <path
                                                    d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17s2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276" />
                                                <path
                                                    d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.8.8 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155s4.037-.084 5.592-.155A1.48 1.48 0 0 0 15 9.611v-.413q0-.148-.03-.294l-.335-1.68a.8.8 0 0 0-.43-.563 1.8 1.8 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3z" />
                                            </svg>
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
                                <h5 class="card-title">Top most stolen</span></h5>

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
