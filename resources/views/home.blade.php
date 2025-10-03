@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js" crossorigin="anonymous"></script>

    <!-- sortablejs -->
    <script>
        new Sortable(document.querySelector('.connectedSortable'), {
            group: 'shared',
            handle: '.card-header',
        });

        const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    </script>
    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

    <!-- ChartJS -->
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        const sales_chart_options = {
            series: [{
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    </script>

    <!-- jsvectormap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>

    <!-- jsvectormap -->
    <script>
        // World map by jsVectorMap
        new jsVectorMap({
            selector: '#world-map',
            map: 'world',
        });

        // Sparkline charts
        const option_sparkline1 = {
            series: [{
                data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
        sparkline1.render();

        const option_sparkline2 = {
            series: [{
                data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
        sparkline2.render();

        const option_sparkline3 = {
            series: [{
                data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
            }, ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
        sparkline3.render();
    </script>
    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            function formatDate(date) {
                return date.toISOString().split('T')[0];
            }

            const today = new Date();
            const lastWeek = new Date();
            //lastWeek.setDate(today.getDate() - 7);

            document.getElementById("dateFrom").value = formatDate(lastWeek);
            document.getElementById("dateTo").value = formatDate(today);

            // Optional: prevent selecting future dates
            document.getElementById("dateTo").setAttribute("max", formatDate(today));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let barGraph=null;
        function loadBarChart(from, to) {
            // Fix URL construction - use template literals or proper concatenation
            const url = `/api/dashboard/${from}/${to}/barchart`;
            console.log('Url', url);

            $.post(url, {_token: $('input[name="_token"]').val()})
                .done(function(data) {

                    //console.log('Chart data',data)
                    var myDay = [];
                    var myNum = [];

                    var disp = 'Daily Customer Registration';

                    if (data.data.values.length <= 0) {
                        disp = 'Daily Customer Registration Sample Display';
                        myDay = [];
                        myNum = [];
                    } else {
                        myDay = data.data.labels
                        myNum = data.data.values
                    }

                    var chartData = {
                        labels: myDay,
                        datasets: [{
                            label: disp,
                            backgroundColor: 'rgba(0, 150, 85, 1)',
                            borderColor: 'rgba(200,200,200,0.75)',
                            hoverBackgroundColor: 'rgba(200,200,200,1)',
                            hoverBorderColor: 'rgba(200,200,200,0.75)',
                            data: myNum

                        }]
                    }

                    var ctx = $('#ctx_daily_reg');

                    if(barGraph){
                      barGraph.destroy()
                    }

                    barGraph = new Chart(ctx, {
                        type: 'bar',
                        data: chartData
                    });

                })
                .fail(function(xhr, status, error) {
                    $('.alert-dismissible').hide();

                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Laravel validation error
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                    } else if (xhr.status === 400) {
                        // Bad request
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorHtml += '<li>' + xhr.responseJSON.message + '</li>';
                        } else {
                            errorHtml += '<li>Bad request. Please check your input.</li>';
                        }
                    } else {
                        // General / server error
                        errorHtml += '<li>An unexpected error occurred. Please try again later.</li>';
                    }

                    errorHtml += '</ul></div>';
                    $('#alertWarning').html(errorHtml).show();
                });
        }

        function loadDashboard(from, to) {
            const url = `/api/dashboard/${from}/${to}/summaries`;
            $.post(url, {
                    _token: $('input[name="_token"]').val()
                })
                .done(function(data) {
                    // Use nullish coalescing operator (??) instead of bitwise OR (|)
                    const totalonlineCount = data.data.totalOnlineCount ?? 0;
                    const totalonlineAmount = data.data.totalOnlineAmount ?? 0;

                    $('#prepaid-online-count').text(`${totalonlineCount}`);
                    $('#prepaid-online-amount').text(`GHS ${totalonlineAmount}`);

                    const totalOfflineCount = data.data.totalOfflineCount ?? 0;
                    const totalOfflineAmount = data.data.totalOfflineAmount ?? 0;

                    $('#prepaid-offline-count').text(`${totalOfflineCount}`);
                    $('#prepaid-offline-amount').text(`GHS ${totalOfflineAmount}`);

                    const totalPostpaidCount = data.data.totalPostpaidCount ?? 0;
                    const totalPostpaidAmount = data.data.totalPostpaidAmount ?? 0;

                    $('#postpaid-count').text(`${totalPostpaidCount}`);
                    $('#postpaid-amount').text(`GHS ${totalPostpaidAmount}`);

                    const totalAirtimeCount = data.data.totalAirtimeCount ?? 0;
                    const totalAirtimeAmount = data.data.totalAirtimeAmount ?? 0;

                    $('#airtime-count').text(totalAirtimeCount);
                    $('#airtime-amount').text(`GHS ${totalAirtimeAmount}`);

                    const totalBankCount = data.data.totalBankCount ?? 0;
                    const totalBankAmount = data.data.totalBankAmount ?? 0;

                    $('#bank-count').text(totalBankCount);
                    $('#bank-amount').text(`GHS ${totalBankAmount}`);

                    const totalMomoCount = data.data.totalMomoCount ?? 0;
                    const totalMomoAmount = data.data.totalMomoAmount ?? 0;

                    $('#momo-count').text(totalMomoCount);
                    $('#momo-amount').text(`GHS ${totalMomoAmount}`);

                    // Calculate totals
                    const totalCount = totalonlineCount + totalOfflineCount + totalPostpaidCount +
                        totalAirtimeCount + totalBankCount + totalMomoCount;
                    const totalAmount = Number(totalonlineAmount + totalOfflineAmount + totalPostpaidAmount +
                        totalAirtimeAmount + totalBankAmount + totalMomoAmount);

                    $('#payment-count').text(totalCount);
                    $('#payment-amount').text(`GHS ${totalAmount}`);

                    // Fix duplicate addition in total_transactions calculation
                    const total_transactions = totalAmount; // This was adding bank and momo twice

                    const total_revenue = (5 / 100) * total_transactions;

                    $('#all-transactions').text(`GHS ${total_transactions}`);
                    $('#total-revenue').text(`GHS ${total_revenue.toFixed(2)}`); // Add decimal formatting
                })
                .fail(function(xhr, status, error) {
                    $('.alert-dismissible').hide();

                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Laravel validation error
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                    } else if (xhr.status === 400) {
                        // Bad request
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorHtml += '<li>' + xhr.responseJSON.message + '</li>';
                        } else {
                            errorHtml += '<li>Bad request. Please check your input.</li>';
                        }
                    } else {
                        // General / server error
                        errorHtml += '<li>An unexpected error occurred. Please try again later.</li>';
                    }

                    errorHtml += '</ul></div>';
                    $('#alertWarning').html(errorHtml).show();
                });
        }


        $(document).ready(function() {
            $('#goBtn').trigger('click')
        })
    </script>
    <script>
        const goBtn = document.getElementById("goBtn");
        const spinner = goBtn.querySelector(".spinner");

        goBtn.addEventListener("click", function() {
            // Show spinner
            spinner.classList.remove("d-none");
            goBtn.setAttribute("data-loading", "true");

            // Simulate a process
            setTimeout(() => {
                spinner.classList.add("d-none");
                goBtn.removeAttribute("data-loading");

                //evt.preventDefault();
                dateFrom = $('#dateFrom').val()
                dateTo = $('#dateTo').val()

                loadDashboard(dateFrom, dateTo)
                loadBarChart(dateFrom,dateTo)
            }, 3000); // 3s fake load
        });
    </script>
@endsection
@include('components.dashboard-widgets')
@endsection
