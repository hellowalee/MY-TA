@extends('template-wpadmin')
@section('navbar_dashboard','active')
@section('main')

<div class="container-fluid plr_30 body_white_bg pt_30">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="single_element">
                <div class="quick_activity">
                    <div class="row">
                        <div class="col-12">
                            <div class="quick_activity_wrap">
                                <?php 
                                    // ubah format angka menjadi format rupiah
                                    $totalCurrentValueTanah = number_format($totalCurrentValueTanah,2,',','.');
                                    $totalCurrentValueBangunan = number_format($totalCurrentValueBangunan,2,',','.');
                                ?>
                                <div class="single_quick_activity">
                                    <h4>Jumlah Aset Tanah</h4>
                                    <h3> <span class="counter">{{$totalAssetTypeTanah}}</span> </h3>
                                    {{-- <p>Saved 25%</p> --}}
                                </div>
                                <div class="single_quick_activity">
                                    <h4>Jumlah Aset Bangunan</h4>
                                    <h3> <span class="counter">{{$totalAssetTypeBangunan}}</span> </h3>
                                    {{-- <p>Saved 25%</p> --}}
                                </div>
                                <div class="single_quick_activity">
                                    <h4>Total Nilai Tanah Saat Ini</h4>
                                    <h3>Rp <span class="">{{ $totalCurrentValueTanah }} </span> </h3>
                                    {{-- <p>Saved 25%</p> --}}
                                </div>
                                <div class="single_quick_activity">
                                    <h4>Total Nilai Bangunan Saat Ini</h4>
                                    <h3>Rp <span class="">{{ $totalCurrentValueBangunan }}</span> </h3>
                                    {{-- <p>Saved 25%</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center text-center">
            <div class="col-md-7 text-center">
                <canvas id="tanahChart" width="500" height="500"></canvas>
            </div>

            <div class="col-md-5 text-center">
                <canvas id="myBarChart" width="500" height="500"></canvas>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var tanahCtx = document.getElementById('tanahChart').getContext('2d');
        
                var tanahData = {
                    labels: ['Jumlah Perolehan Nilai Tanah', 'Jumlah Perolehan Nilai Bangunan'],
                    datasets: [{
                        label: 'Tanah',
                        data: [{{$totalAcquisitionValueTanah}}, {{$totalAcquisitionValueBangunan}}],
                        backgroundColor: ['rgba(166, 215, 151)', 'rgba(125, 172, 192)'],
                        hoverBackgroundColor: ['rgba(166, 215, 151)', 'rgba(125, 172, 192)']
                    }]
                };
        
                var tanahChart = new Chart(tanahCtx, {
                    type: 'doughnut',
                    data: tanahData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 16 // Adjust the font size for the legend
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        let value = context.raw || 0;
                                        return `${label}: Rp. ${value.toLocaleString()}`;
                                    }
                                },
                                bodyFont: {
                                    size: 60 // Adjust the font size for the tooltip body
                                }
                            }
                        }
                    }
                });
            });
        </script>
        


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('myBarChart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Disewakan', 'Tidak Sedang Digunakan', 'Sedang Digunakan'],
                    datasets: [
                        {
                            label: 'Tanah',
                            data: [{{$totalAssetTypeTanahDisewakan}}, {{$totalAssetTypeTidakSedangDigunakan}}, {{$totalAssetTypeSedangDigunakan}}],
                            backgroundColor: 'rgba(177, 142, 148)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Bangunan',
                            data: [{{$totalAssetTypeBangunanTanahDisewakan}}, {{$totalAssetTypeBangunanTidakSedangDigunakan}}, {{$totalAssetTypeBangunanSedangDigunakan}}],
                            backgroundColor: 'rgba(218, 215, 151)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        {{-- 
        <div class="col-lg-12 col-xl-6">
            <div class="white_box mb_30 min_430">
                <div class="box_header  box_header_block ">
                    <div class="main-title">
                        <h3 class="mb-0">AP and AR Balance</h3>
                        <span>Avg. $5,309</span>
                    </div>
                    <div class="box_select d-flex">
                        <select class="nice_Select2 mr_5">
                            <option value="1">Monthly</option>
                            <option value="1">Monthly</option>
                        </select>
                        <select class="nice_Select2 ">
                            <option value="1">Last Year</option>
                            <option value="1">this Year</option>
                        </select>
                    </div>
                </div>
                <div id="bar_active"></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3 ">
            <div class="white_box mb_30 min_430">
                <div class="box_header  box_header_block">
                    <div class="main-title">
                        <h3 class="mb-0">% of Income Budget</h3>
                    </div>
                </div>
                <div id="radial_2"></div>
                <div class="radial_footer">
                    <div class="radial_footer_inner d-flex justify-content-between">
                        <div class="left_footer">
                            <h5> <span style="background-color: #EDECFE;"></span> Blance</h5>
                            <p>-$18,570</p>
                        </div>
                        <div class="left_footer">
                            <h5> <span style="background-color: #A4A1FB;"></span> Blance</h5>
                            <p>$31,430</p>
                        </div>
                    </div>
                    <div class="radial_bottom">
                        <p><a href="https://demo.dashboardpack.com/finance-html/#">View Full Report</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="white_box min_430">
                <div class="box_header  box_header_block">
                    <div class="main-title">
                        <h3 class="mb-0">% of Expenses Budget</h3>
                    </div>
                </div>
                <div id="radial_1"></div>
                <div class="radial_footer">
                    <div class="radial_footer_inner d-flex justify-content-between">
                        <div class="left_footer">
                            <h5> <span style="background-color: #EDECFE;"></span> Blance</h5>
                            <p>-$18,570</p>
                        </div>
                        <div class="left_footer">
                            <h5> <span style="background-color: #A4A1FB;"></span> Blance</h5>
                            <p>$31,430</p>
                        </div>
                    </div>
                    <div class="radial_bottom">
                        <p><a href="https://demo.dashboardpack.com/finance-html/#">View Full Report</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="white_box mb_30 min_430">
                <div class="box_header  box_header_block">
                    <div class="main-title">
                        <h3 class="mb-0">EBIT (Earnings Before Interest & Tax)</h3>
                    </div>
                </div>
                <canvas height="200" id="visit-sale-chart"></canvas>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="white_box mb_30 min_430">
                <div class="box_header  box_header_block align-items- ">
                    <div class="main-title">
                        <h3 class="mb-0">Cost of goods / Services</h3>
                    </div>
                    <div class="title_info">
                        <p>1 Jan 2020 to 31 Dec 2020 <br>
                        <div class="legend_style text-end">
                            <li> <span style="background-color: #A4A1FB;"></span> Services</li>
                            <li class="inactive"> <span style="background-color: #A4A1FB;"></span> Avarage
                            </li>
                        </div>
                        </p>
                    </div>
                </div>
                <canvas height="200" id="visit-sale-chart2"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="white_box mb_30 min_400">
                <div class="box_header ">
                    <div class="main-title">
                        <h3 class="mb-0">Disputed vs Overdue Invoices</h3>
                    </div>
                </div>
                <canvas height="220px" id="doughutChart"></canvas>
                <div class="legend_style mt_10px ">
                    <li class="d-block"> <span style="background-color: #DF67C1;"></span> Disputed
                        Invoices</li>
                    <li class="d-block"> <span style="background-color: #6AE0BD;"></span> Avarage</li>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6">
            <div class="white_box mb_30 min_400 ">
                <div class="box_header  box_header_block">
                    <div class="main-title">
                        <h3 class="mb-0">Disputed Invoices</h3>
                    </div>
                    <div class="legend_style mt-10">
                        <li> <span></span> Disputed Invoices</li>
                        <li class="inactive"> <span></span> Avarage</li>
                    </div>
                </div>
                <div class="title_btn">
                    <ul>
                        <li><a class="active" href="https://demo.dashboardpack.com/finance-html/#">All
                                time</a></li>
                        <li><a href="https://demo.dashboardpack.com/finance-html/#">This year</a></li>
                        <li><a href="https://demo.dashboardpack.com/finance-html/#">This week</a></li>
                        <li><a href="https://demo.dashboardpack.com/finance-html/#">Today</a></li>
                    </ul>
                </div>
                <canvas height="120px" id="sales-chart"></canvas>
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="white_box mb_30 min_400">
                <div class="box_header  box_header_block">
                    <div class="main-title">
                        <h3 class="mb-0">Disputed vs Overdue Invoices</h3>
                    </div>
                </div>
                <canvas height="220px" id="doughutChart2"></canvas>
                <div class="legend_style legend_style_grid mt_10px">
                    <li class="d-block"> <span style="background-color: #FF7B36;"></span> 30 Days</li>
                    <li class="d-block"> <span style="background-color: #E8205E;"></span> 60 Days</li>
                    <li class="d-block"> <span style="background-color: #3B76EF"></span> 90 Days</li>
                    <li class="d-block"> <span style="background-color:#00BFBF;"></span> 90+Days</li>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="white_box min_400">
                <div class="box_header  box_header_block">
                    <div class="main-title">
                        <h3 class="mb-0">EBIT (Earnings Before Interest & Tax)</h3>
                    </div>
                    <div class="title_info">
                        <p>1 Jan 2020 to 31 Dec 2020</p>
                    </div>
                </div>
                <div id="area_active"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="white_box mb_30 min_400">
                <div class="box_header ">
                    <div class="main-title">
                        <h3 class="mb-0">Inventory Turnover</h3>
                    </div>
                </div>
                <div id="stackbar_active"></div>
            </div>
        </div> 
        --}}

    </div>
</div>

@endsection
